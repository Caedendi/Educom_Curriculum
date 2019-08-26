<?php

include_once PROJECT_ROOT . "data_management\database_manager.php";

class UserDatabaseManager extends DatabaseManager {

  static function findUserByEmail(string $email) {
    $userData = NULL;
    try {
      $link = DatabaseManager::connectToDatabase();
      $e = mysqli_real_escape_string($link, $email); // is dit de juiste toepassing van msqli_real_escape_string of moet dit eerder, bijvoorbeeld in getPostValue()?
      $sql = '
        SELECT *
        FROM users
        WHERE email="' . $e . '"
      ';
      if(!($result = $link->query($sql))) {
        throw new DatabaseQueryException("Database query failed when saving to database:" . PHP_EOL . mysqli_error($link) . PHP_EOL);
      }
      /* Indien deze query 'false' retourneert is het mislukt en zou je een DatabaseQueryException moeten gooien */
      $userData = $result->fetch_assoc();
      return $userData;
    }
    finally {
      mysqli_close($link);
    }
  }

  static function saveUser($name, $email, $password) {
    try {
      $link = DatabaseManager::connectToDatabase();
      $n = mysqli_real_escape_string($link, $name);
      $e = mysqli_real_escape_string($link, $email);
      $p = mysqli_real_escape_string($link, $password);
      $sql = '
        INSERT INTO users (
          email,
          password,
          name)
        VALUES (
          "' . $e . '",
          "' . $p . '",
          "' . $n . '")
      ';

      if (!$link->query($sql)) {
        throw new DatabaseQueryException("Database query failed when saving to database:" . PHP_EOL . mysqli_error($link) . PHP_EOL);
      }
    }
    finally {
      mysqli_close($link);
    }
  }

  //==============================
  // Not yet implemented
  //==============================
  static function deleteUser($id) {
   /* JH: Beter geen lege functie in een file laten staan, mensen denken dan dat ze deze kunnen gebruiken */
  }


}
?>
