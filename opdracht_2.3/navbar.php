<?php

// button logout krijgt tekst: Logout [naam]
// logout alleen laten zien wanneer ingelogd
// login/register alleen laten zien wanneer niet ingelogd

function showMenu($page) {
  showMenuStart();
  showMenuItem('home', "HOME", "regularPage", $page);
  showMenuItem('about', "ABOUT", "regularPage", $page);
  showMenuItem('contact', "CONTACT", "regularPage", $page);
  if (DEBUG_TEST_PAGE) { showMenuItem('debug', "DEBUG", "regularPage", $page); }
  /* JH TIP: Laat alle interactie met $_SESSION lopen via 1 php file, bijv. session_manager.php met functies als: loginUser($name, $email), isUserLoggedIn(), getLoggedInUserName(), logoutUser() etc */
  if (isset($_SESSION['user'])) {
    $firstName = substr($_SESSION['user_name'], 0, strpos($_SESSION['user_name'], " ")); /* JH TIP: Dit kan korter met explode(' ', $_SESSION['userName'])[0] */
    showMenuItem('logout', "LOGOUT [" . $firstName . "]", "logout", $page);
  }
  else {
    showMenuItem('login', "LOGIN", "login", $page);
    showMenuItem('register', "REGISTER", "login", $page);
  }
  showMenuEnd();
}

function showMenuStart() {
  echo '
    <div class="navbar">
      <ul>
  ';
}

function showMenuEnd() {
  echo '
      </ul>
    </div>
  ';
}

function showMenuItem($linkParameter, $buttonLabel, $navButtonClass, $page) {
  echo '
    <li class="' . $navButtonClass . '"><a ';
      if ($page == $linkParameter) { echo 'class="active" '; }
      echo 'href="index.php?page=' . $linkParameter . '">' . $buttonLabel . '</a></li>
  ';
  /* JH: TIP de width in de navButtonClass gaat je later nog in de problemen geven, beter om de brouwser die te laten bepalen en hier alleen een class toevoegen voor de buttons die rechts moeten worden uitgelijnd */
}
?>
