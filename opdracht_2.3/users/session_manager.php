<?php

/* JH TIP: Laat alle interactie met $_SESSION lopen via 1 php file, bijv.
  session_manager.php met functies als:
  loginUser($name, $email), isUserLoggedIn(), getLoggedInUserName(), logoutUser() etc
*/

function loginUser($name, $email) {
  $_SESSION['isLoggedIn'] = true;
  $_SESSION['userName'] = $name;
  $_SESSION['userEmail'] = $email;
}

function isUserLoggedIn() {
  return isset($_SESSION['isLoggedIn']) ? $_SESSION['isLoggedIn'] : false;
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
?>
