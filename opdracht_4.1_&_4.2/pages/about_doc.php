<?php
require_once PROJECT_ROOT . "pages\basic_doc.php";

class AboutDoc extends BasicDoc {
  public function __construct($model) {
    parent::__construct($model);
  }

  protected function mainContent() {
    echo
      "<p>Mijn naam is Bart Commandeur. Ik ben 26 jaar, kom uit het Noord-Hollandse
      Hoogkarspel en woon ondertussen al 4 jaar in Utrecht. Momenteel volg ik een
      traineeship bij Educom tot software developer. Hiervoor heb ik lang gepoogd te
      studeren, en terwijl mij toen wel duidelijk werd dat mijn toekomst in de ICT ligt,
      werd mij ook duidelijk dat dit niet het juiste pad voor mij was. Dat juiste pad
      hoop ik nu bij Educom echter wel gevonden te hebben. </p>

      <p>In mijn vrije tijd ben ik vaak te vinden achter de computer om te gamen,
      films en series te kijken, muziek te verzamelen en luisteren, en wanneer ik
      gitaar speel. Tabs, noten, tutorials, etc opzoeken en bekijken gaat tegenwoordig
      natuurlijk ook allemaal digitaal. Ook bezoek ik vrij veel concerten en festivals
      en vind ik het erg belangrijk om mijn sociale contacten te onderhouden. </p>

      <p>Hier volgt nog een opsomming van mijn hobbies:</p>

      <ul>
       <li>Concerten en festivals bezoeken</li>
       <li>Gitaar spelen</li>
       <li>Films en series kijken</li>
       <li>Games spelen</li>
      </ul>" . PHP_EOL;
  }
}
?>
