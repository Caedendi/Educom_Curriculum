<?php
abstract class DatabaseManager {
  static function connectToDatabase() {
    $server = "localhost";
    $username = "educom1";
    $password = "monitor";
    $database = "bartcommandeur_webshop";
    $link = new mysqli($server, $username, $password, $database);
    if ($link->connect_errno) {
      throw new DatabaseConnectionException("Unable to connect to database:" . PHP_EOL . mysqli_connect_errno() . ": " . mysqli_connect_error() . PHP_EOL . PHP_EOL);
    }
    return $link;
  }

  static function findEntry(string $table, string $id, string $key) {
    try {
      $link = DatabaseManager::connectToDatabase();
      // $key = mysqli_real_escape_string($link, $key);
      $sql = '
        SELECT *
        FROM ' . $table . '
        WHERE ' . $id . ' = ' . $key . '
      ';
      if(!$result = $link->query($sql)) {
        throw new DatabaseQueryException; }
      else {
        $entry = $result->fetch_assoc();
        return $entry;
      }
    }
    finally {
      $link->close();
    }
  }

  static function findMultipleEntries(string $table, string $id, array $keys) {
    if (empty($keys)) {
      throw new Exception("input keys of findMultipleEntries() is empty");
      return;
    }

    $entryList = array();
    try {
      $link = DatabaseManager::connectToDatabase();
      $sql = "
        SELECT *
        FROM products
        WHERE $id IN (" . implode(', ', $keys) . ")
      ";
      //array_map('mysqli_real_escape_string', $link, $arrayOfIds)) . ")
      /* JH: Deze code is vatbaar voor SQL-injectie, als iemand als emailadres invult:
             "bla@bla '; DROP TABLE users; --" dan wordt de hele $sql hieronder:
             "SELECT * FROM users WHERE email = 'bla@bla'; DROP TABLE users; --'" dit wordt
             door mysql als 2 commando's en een commentaar geinterpreteerd.

             om dit te voorkomen moet alle data die van 'buiten' de server komt worden gevalideerd
             en ontdaan van de gevaarlijke karakters met de functie "mysqli_real_escape_string"
             dus $email = mysqli_real_escape_string($link, $email);
      */



      /* Indien deze query 'false' retourneert is het mislukt en zou je een DatabaseQueryException moeten gooien */
      if (!$result = $link->query($sql)) {
        throw new DatabaseQueryException; }
      else {
        while ($row = $result->fetch_assoc()) {
          array_push($entryList, $row); }
        return $entryList;
      }
    }
    finally {
      mysqli_close($link);
    }
  }

  static function findAllEntries(string $table) {
    $entryList = array();
    try {
      $link = DatabaseManager::connectToDatabase();
      $sql = '
        SELECT *
        FROM ' . $table . '
      ';
      if (!$result = $link->query($sql)) {
        throw new DatabaseQueryException;
      }
      else {
        while ($row = mysqli_fetch_assoc($result)) {
          array_push($entryList, $row);
        }
        return $entryList;
      }
    }
    finally {
      mysqli_close($link);
    }
  }

  static function saveEntry(string $table, array $values) {

  }

  static function saveMultipleEntries(string $table, array $values) {

  }

  static function modifyEntry(string $table, string $id, array $values) {

  }

  static function deleteEntry(string $table, string $id) {

  }
}
?>
