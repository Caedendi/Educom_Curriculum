<?php
function loginUser($id, $name, $email) {
  $_SESSION['isLoggedIn'] = true;
  $_SESSION['userId'] = $id;
  $_SESSION['userName'] = $name;
  $_SESSION['userEmail'] = $email;
}

function isUserLoggedIn() {
  return isset($_SESSION['isLoggedIn']) ? $_SESSION['isLoggedIn'] : false;
}

function getLoggedInUserId() {
  if (isUserLoggedIn()) {
    return isset($_SESSION['userId']) ? $_SESSION['userId'] : NULL;
  }
  else {
    echo PHP_EOL . 'no user logged in' . PHP_EOL;
    return NULL;
  }
}

function getLoggedInUserName() {
  if (isUserLoggedIn()) {
    return isset($_SESSION['userName']) ? $_SESSION['userName'] : NULL;
  }
  else {
    echo PHP_EOL . 'no user logged in' . PHP_EOL;
    return NULL;
  }
}

function getLoggedInUserFirstName() {
  if (isUserLoggedIn()) {
    return isset($_SESSION['userName']) ? explode(' ', $_SESSION['userName'])[0] : NULL;
  }
  else {
    echo PHP_EOL . 'no user logged in' . PHP_EOL;
    return NULL;
  }
}

function getLoggedInUserEmail() {
  if (isUserLoggedIn()) {
    return isset($_SESSION['userEmail']) ? $_SESSION['userEmail'] : NULL;
  }
  else {
    echo PHP_EOL . 'no user logged in' . PHP_EOL;
    return NULL;
  }
}

function logoutUser() {
  session_unset();
  session_destroy();
}

function getCart() {
  return isset($_SESSION['cart']) ? $_SESSION['cart'] : NULL;
}

function isCartFilled() {
  return isset($_SESSION['cart']) ? true : false;
}

function emptyCart() {
  unset($_SESSION['cart']);
}

function addToCart($itemId, $amount) {
  if ($amount < 1) {
    throw new Exception("Hoi, je wilt iets kleiner dan 0 toevoegen aan je cart. Maak deze exceptie af.");
  }
  if (!isset($_SESSION['cart'][$itemId])) {
    $_SESSION['cart'][$itemId] = $amount;
  }
  else {
    $_SESSION['cart'][$itemId] += $amount;
  }
}

function removeFromCart($itemId) {
  if (isset($_SESSION['cart'][$itemId])) {
    unset($_SESSION['cart'][$itemId]);
    if (empty($_SESSION['cart'])) {
      unset($_SESSION['cart']);
    }
  }
}

function changeAmountInCart($itemId, $amount) {
  if ($amount > 1) {
    $_SESSION['cart'][$itemId] = $amount;
  } else
  if ($amount == 0) {
    removeFromCart($itemId);
  } else
  if ($amount < 1) {
    throw new Exception("Hoi, je wilt iets naar kleiner dan 0 wijzigen in je cart. Maak deze exceptie af.");
  }
  // TODO:
    // revert [0] id / amount / price
    // implement checkIfPricesChanged()
    // implement confirmation page with changed prices
}

function getItemTotalInCart() {
  $total = 0;
  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $itemId => $amount) {
      $total += $amount;
    }
  }
  return $total;
}
?>
