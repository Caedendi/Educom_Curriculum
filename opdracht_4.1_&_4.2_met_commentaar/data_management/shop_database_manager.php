<?php

include_once PROJECT_ROOT . "data_management\database_manager.php";

class ShopDatabaseManager extends DatabaseManager {

  static function findProductById($id) {
    if (empty($id)) {
      throw new Exception("input of findProductById() is empty");
      return;
    }
    $product = NULL;
    try {
      $link = DatabaseManager::connectToDatabase();
      $sql = '
        SELECT *
        FROM products
        WHERE id="' . $id . '"
      ';
      /* JH: Deze code is vatbaar voor SQL-injectie, als iemand als emailadres invult:
             "bla@bla '; DROP TABLE users; --" dan wordt de hele $sql hieronder:
             "SELECT * FROM users WHERE email = 'bla@bla'; DROP TABLE users; --'" dit wordt
             door mysql als 2 commando's en een commentaar geinterpreteerd.

             om dit te voorkomen moet alle data die van 'buiten' de server komt worden gevalideerd
             en ontdaan van de gevaarlijke karakters met de functie "mysqli_real_escape_string"
             dus $email = mysqli_real_escape_string($link, $email);
      */

      /* Indien deze query 'false' retourneert is het mislukt en zou je een DatabaseQueryException moeten gooien */
      if (!$result = mysqli_query($link, $sql)) {
        throw new DatabaseQueryException("findProductById query failed");
      }
      else {
        $product = mysqli_fetch_assoc($result);
        return $product;
      }
    }
    finally {
      mysqli_close($link);
    }
  }

  static function findMultipleProductsById($arrayOfIds) {
    if (empty($arrayOfIds)) {
      throw new Exception("input of findMultipleProductsById() is empty");
      return;
    }

    $productList = array();
    try {
      $link = DatabaseManager::connectToDatabase();
      $sql = "
        SELECT *
        FROM products
        WHERE id IN (" . implode(', ', $arrayOfIds) . ")
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
      if (!$result = mysqli_query($link, $sql)) {
        throw new DatabaseQueryException; }
      else { // store all rows as arrays in $productIdList
        while ($row = mysqli_fetch_assoc($result)) {
          array_push($productList, $row); }
        // print_r($productList); echo '<br><br>'; // print each row to screen
        return $productList;
      }
    }
    finally {
      mysqli_close($link);
    }
  }

  /*
   *
  // $productList w/
  // [0]id, quantity, price_unit
  // [1]id, quantity, price_unit
  // etc
   *
   */
  static function saveOrder($userId, $productList) {
    if (empty($userId)) {
      throw new Exception("input userID of saveOrder() is empty");
      return;
    }
    if (empty($productList)) {
      throw new Exception("input productList of saveOrder() is empty");
      return;
    }
    try {
      $link = DatabaseManager::connectToDatabase();
      mysqli_autocommit($link, false);

      $query1 = '
        INSERT INTO orders (
          user_id
        )
        VALUES (
          ' . $userId . '
        )
      ';
      if (!$result = mysqli_query($link, $query1)) {
        throw new DatabaseQueryException("query1 mislukt");
      }
      // get newly created orderID
      $orderId = mysqli_insert_id($link); /* JH: Dit kan beter met de functie mysqli_insert_id($conn); */
      if (!$orderId = mysqli_insert_id($link)) {
        throw new DatabaseQueryException("orderID is empty. New order has been successfully made and stored, but it somehow has failed to be given an ID in database.");
      }
      /* JH: Niet alle databases kunnen multiple insert aan, het is beter om er meerdere queries van te maken */
      // make array of values strings for all items in order
      foreach ($productList as $key => $item) {
        $valuesList[] = "(" . $orderId . ", " . $item['id'] . ", " . $item['quantity'] . ", " . $item['price_unit'] . ")";
      }

      $query2 = '
        INSERT INTO orders_products (
          order_id,
          product_id,
          quantity,
          price_unit
        )
        VALUES
          ' . implode(", ", $valuesList) . '
      ';
      if (!$result = mysqli_query($link, $query2)) {
        throw new DatabaseQueryException("query2 mislukt");
      }

      mysqli_commit($link);
      return $orderId;
    } // end try
    catch (Exception $e) {
      echo $e->getMessage();
      echo mysqli_error($link);
      mysqli_rollback($link);
      throw $e;
    }
    finally {
      mysqli_autocommit($link, true);
      mysqli_close($link);
    }
  }



} // end class
?>
