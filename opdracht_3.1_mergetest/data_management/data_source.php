<?php
function connectToDatabase() {
  $server = "localhost";
  $username = "educom1";
  $password = "monitor";
  $database = "educom";
  $link = mysqli_connect($server, $username, $password, $database);
  if (!$link) {
    throw new DatabaseConnectionException("Unable to connect to database:" . PHP_EOL . mysqli_connect_errno() . ": " . mysqli_connect_error() . PHP_EOL . PHP_EOL);
  }
  return $link;
}

function findUserByEmail($email) {
  $userData = NULL;
  try {
    $link = connectToDatabase();
    $e = mysqli_real_escape_string($link, $email); // is dit de juiste toepassing van msqli_real_escape_string of moet dit eerder, bijvoorbeeld in getPostValue()?
    $sql = '
      SELECT *
      FROM users
      WHERE email="' . $e . '"
    ';
    /* JH: Deze code is vatbaar voor SQL-injectie, als iemand als emailadres invult:
           "bla@bla '; DROP TABLE users; --" dan wordt de hele $sql hieronder:
           "SELECT * FROM users WHERE email = 'bla@bla'; DROP TABLE users; --'" dit wordt
           door mysql als 2 commando's en een commentaar geinterpreteerd.

           om dit te voorkomen moet alle data die van 'buiten' de server komt worden gevalideerd
           en ontdaan van de gevaarlijke karakters met de functie "mysqli_real_escape_string"
           dus $email = mysqli_real_escape_string($link, $email);
    */

    $result = mysqli_query($link, $sql);
    /* Indien deze query 'false' retourneert is het mislukt en zou je een DatabaseQueryException moeten gooien */
    $userData = mysqli_fetch_assoc($result);
    return $userData;
  }
  finally {
    mysqli_close($link);
  }
}

function saveUser($name, $email, $password) {
  try {
    $link = connectToDatabase();
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

    if (!mysqli_query($link, $sql)) {
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
function deleteUser($id) {
 /* JH: Beter geen lege functie in een file laten staan, mensen denken dan dat ze deze kunnen gebruiken */
}

function findProductById($id) {
  if (empty($id)) {
    throw new Exception("input of findProductById() is empty");
    return;
  }
  $product = NULL;
  try {
    $link = connectToDatabase();
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

function findMultipleProductsById($arrayOfIds) {
  if (empty($arrayOfIds)) {
    throw new Exception("input of findMultipleProductsById() is empty");
    return;
  }

  $productList = array();
  try {
    $link = connectToDatabase();
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

function findAllProducts() {
  $productList = array();
  try {
    $link = connectToDatabase();
    $sql = '
      SELECT *
      FROM products
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
      throw new DatabaseQueryException;
    }
    else {
      // store all rows as arrays in $productIdList
      while ($row = mysqli_fetch_assoc($result)) {
        // print_r($row); echo '<br><br>'; // print each row to screen
        array_push($productList, $row);
      }
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
function saveOrder($userId, $productList) {
  if (empty($userId)) {
    throw new Exception("input userID of saveOrder() is empty");
    return;
  }
  if (empty($productList)) {
    throw new Exception("input productList of saveOrder() is empty");
    return;
  }
  try {
    $link = connectToDatabase();
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
    $orderId = mysqli_insert_id($link);
    if (!$orderId = mysqli_insert_id($link)) {
      throw new DatabaseQueryException("orderID is empty. New order has been successfully made and stored, but it somehow has failed to be given an ID in database.");
    }
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

function updateOrder($orderId, $itemsToBeUpdated) {

}
?>
