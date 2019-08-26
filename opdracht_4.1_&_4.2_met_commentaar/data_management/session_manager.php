<?php
class SessionManager {
  static function loginUser($id, $name, $email) {
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['userId'] = $id;
    $_SESSION['userName'] = $name;
    $_SESSION['userEmail'] = $email;
  }

  static function logoutUser() {
    session_unset();
    session_destroy();
  }

  static function isUserLoggedIn() {
    return isset($_SESSION['isLoggedIn']) ? $_SESSION['isLoggedIn'] : false;
  }

  static function getLoggedInUserId() {
    if (SessionManager::isUserLoggedIn()) {
      return isset($_SESSION['userId']) ? $_SESSION['userId'] : NULL;
    }
    else {
      /* JH: Geen 'echo' gebruiken in utility achtige functies */
      echo PHP_EOL . 'no user logged in' . PHP_EOL;
      return NULL;
    }
  }

  static function getLoggedInUserName() {
    if (SessionManager::isUserLoggedIn()) {
      return isset($_SESSION['userName']) ? $_SESSION['userName'] : NULL;
    }
    else {
      /* JH: Geen 'echo' gebruiken in utility achtige functies */
      echo PHP_EOL . 'no user logged in' . PHP_EOL;
      return NULL;
    }
  }

  static function getLoggedInUserFirstName() {
    if (SessionManager::isUserLoggedIn()) {
      return isset($_SESSION['userName']) ? explode(' ', $_SESSION['userName'])[0] : NULL;
    }
    else {
      /* JH: Geen 'echo' gebruiken in utility achtige functies */
      echo PHP_EOL . 'no user logged in' . PHP_EOL;
      return NULL;
    }
  }

  static function getLoggedInUserEmail() {
    if (SessionManager::isUserLoggedIn()) {
      return isset($_SESSION['userEmail']) ? $_SESSION['userEmail'] : NULL;
    }
    else {
      /* JH: Geen 'echo' gebruiken in utility achtige functies */
      echo PHP_EOL . 'no user logged in' . PHP_EOL;
      return NULL;
    }
  }

  static function getCart() {
    return isset($_SESSION['cart']) ? $_SESSION['cart'] : NULL;
  }

  static function isCartFilled() {
    return isset($_SESSION['cart']) ? true : false;
  }

  static function emptyCart() {
    unset($_SESSION['cart']);
  }

  static function addToCart($itemId, $amount) {
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

  static function removeFromCart($itemId) {
    if (isset($_SESSION['cart'][$itemId])) {
      unset($_SESSION['cart'][$itemId]);
      if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
      }
    }
  }

  static function getAmountInCart($itemId) {
    return isset($_SESSION['cart'][$itemId]) ? $_SESSION['cart'][$itemId] : -1 /* JH: Moet dit niet 0 zijn? */;
  }

  static function changeAmountInCart($itemId, $amount) {
    if ($amount > 1) {
      $_SESSION['cart'][$itemId] = $amount;
    } else
    if ($amount == 0) {
      SessionManager::removeFromCart($itemId);
    } else
    if ($amount < 1) {
      throw new Exception("Hoi, je wilt iets naar kleiner dan 0 wijzigen in je cart. Maak deze exceptie af.");
    }
  }

  static function getItemTotalInCart() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $itemId => $amount) {
        $total += $amount;
      }
    }
    return $total;
  }
}
?>
