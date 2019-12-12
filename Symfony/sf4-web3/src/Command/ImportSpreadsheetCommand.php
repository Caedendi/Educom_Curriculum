<?php

namespace App\Command;

use App\Entity\Poppodium;
use App\Service\AddPoppodiumService;
use mysql_xdevapi\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportSpreadsheetCommand extends Command
{
    private $service;
    private $console;
    private $inputFileName;
    private $spreadsheet;
    private $currentWorksheet;
    private $data = array();

    public function __construct(AddPoppodiumService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:import-spreadsheet')
            ->setDescription('Import Excel Spreadsheet')
            ->setHelp('This command allows you to import a spreadsheet')
            ->addArgument('file', InputArgument::REQUIRED, 'Spreadsheet');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->console = $output;
        $this->inputFileName = $input->getArgument('file');
        $this->spreadsheet = IOFactory::load($this->inputFileName);
        $this->currentWorksheet = $this->spreadsheet->getActiveSheet();

        $this->storeCurrentWorksheet();
        $this->printStoredData($output);
        try {
            for ($i = 0; $i < count($this->data); $i++) {
                $this->validatePoppodium($this->data[$i], $i + 2);
            }
            $this->saveToDatabase();
        } catch (\Exception $e) {
            $this->console->writeln([
                $e->getMessage(),
                "",
                "Database import cancelled.",
            ]);
            die();
        }
    }

    protected function storeCurrentWorksheet()
    {
        $highestRow = $this->currentWorksheet->getHighestDataRow();
        for ($i = 2; $i <= $highestRow; $i++) {
            $this->data[$i - 2] = array(
                "id" => $this->currentWorksheet->getCell('A' . $i)->getValue(),
                "naam" => $this->currentWorksheet->getCell('B' . $i)->getFormattedValue(),
                "adres" => $this->currentWorksheet->getCell('C' . $i)->getFormattedValue(),
                "postcode" => $this->currentWorksheet->getCell('D' . $i)->getFormattedValue(),
                "woonplaats" => $this->currentWorksheet->getCell('E' . $i)->getFormattedValue(),
                "telefoonnummer" => $this->currentWorksheet->getCell('F' . $i)->getFormattedValue(),
                "email" => $this->currentWorksheet->getCell('G' . $i)->getFormattedValue(),
                "website" => $this->currentWorksheet->getCell('H' . $i)->getFormattedValue(),
                "logo_url" => $this->currentWorksheet->getCell('I' . $i)->getFormattedValue(),
                "afbeelding_url" => $this->currentWorksheet->getCell('J' . $i)->getFormattedValue(),
            );
        }
    }

    protected function printStoredData()
    {
        $this->console->writeln([
            "",
            "========== ========== ========== ==========",
            "Data stored in $this->inputFileName:",
            "========== ========== ========== ==========",
            "",
        ]);
        for ($i = 0; $i < count($this->data); $i++) {
            $this->console->writeln([
                '==========',
                'row ' . ($i + 2),
                '==========',
            ]);
            foreach ($this->data[$i] as $key => $value) {
                $this->console->writeln($key . ': ' . $value);
            }
            $this->console->writeln('');
        }
        $this->console->writeln([
            "========== ========== ========== ==========",
            "End stored Data",
            "========== ========== ========== ==========",
            "",
        ]);
    }

    private function validatePoppodium($row, $rowNumber)
    {
        if (count($row) != 10) {
            throw new\Exception(
                "Error in row " . $rowNumber . ": " .
                "The row consists of more than 10 columns.");
        }

        // id = int (11)
        // naam, adres, postcode, woonplaats = string (50)
        // telefoonnummer = string (15)
        // email, website, logo_url, afbeelding_url = string (255)
        foreach ($row as $key => $value) {
            if ($key == "id") { // Can be null. When non-existent in database, a new ID will be generated through auto-increment.
                $this->validateInt($value, $key, $rowNumber);
            } else if ($key == "naam" ||
                $key == "adres" ||
                $key == "postcode" ||
                $key == "woonplaats") {
                $this->validateString($value, $key, $rowNumber, 50, false);
            } else if ($key == "telefoonnummer") {
                $this->validateString($value, $key, $rowNumber, 15, true);
            } else if ($key == "email" ||
                $key == "website" ||
                $key == "logo_url" ||
                $key == "afbeelding_url") {
                $this->validateString($value, $key, $rowNumber, 255, true);
            } else {
                throw new \Exception(
                    "Error in row " . $rowNumber . ": " .
                    "A column (array key) called \"" . $key . "\" was provided that does not match the Poppodium table.");
            }
        }
    }

    private function validateInt($value, $key, $row, $maxSize = null, bool $nullable = false)
    {
        if ($value == null && $nullable == false) {
            throw new\Exception(
                "Error in row " . $row . ": " .
                "\"$key\" can not be null.");
        } else if (!is_int($value)) {
            throw new\Exception(
                "Error in row " . $row . ": " .
                "Value stored in column \"" . $key . "\" is not an int.");
        } else if ($maxSize != null && $value > $maxSize) {
            throw new \Exception(
                "Error in row " . $row . ": " .
                "Value stored in column \"" . $key . "\" exceeds the maximum size of " . $maxSize . ".");
        }
    }

    private function validateString($value, $key, $row, $maxSize = 255, bool $nullable = false)
    {
        if ($value == null && $nullable == false) {
            throw new\Exception(
                "Error in row " . $row . ": " .
                "\"$key\" can not be null.");
        } else if (!is_string($value)) {
            throw new\Exception(
                "Error in row " . $row . ": " .
                "Value stored in column \"" . $key . "\" is not a string.");
        } else if (strlen($row["id"]) > 50) {
            throw new\Exception(
                "Error in row " . $row . ": " .
                "The string exceeds the maximum size of " . $maxSize . " characters.");
        }
    }

    private function saveToDatabase()
    {
        $j = 0;
        $addedRows = 0;
        foreach ($this->data as $row) {
            $j += 1;
            $this->console->writeln([
                "input $j:",
                "",
            ]);
            foreach ($row as $key => $value) {
                $this->console->writeln($key . ": " . $value);
            }
            $this->console->writeln([
                "",
                "inserting into database...",
            ]);
            $this->service->addPoppodium($row);
            $this->console->writeln([
                "input $j [id = " . $row["id"] . "] has been inserted into the database.",
                "",
            ]);
            $addedRows += 1;
        }
        $this->console->writeln("");
        $this->console->writeln($addedRows . " rows added to database.");
    }
}