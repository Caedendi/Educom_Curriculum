<?php
function showMenu($page) {
  showMenuStart();
  showMenuItem('home', "HOME", "regularPage", $page);
  showMenuItem('about', "ABOUT", "regularPage", $page);
  showMenuItem('contact', "CONTACT", "regularPage", $page);
  if (DEBUG_TEST_PAGE) { showMenuItem('debug', "DEBUG", "regularPage", $page); }
  if (isUserLoggedIn()) {
    showMenuItem('logout', "LOGOUT [" . explode(' ', $_SESSION['userName'])[0] . "]", "logout", $page); // shows logged in user's first name on logout button
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
