<?php

// button logout krijgt tekst: Logout [naam]
// logout alleen laten zien wanneer ingelogd
// login/register alleen laten zien wanneer niet ingelogd

function showMenu($page) {
  showMenuStart();
  showMenuItem('home', "HOME", $page);
  showMenuItem('about', "ABOUT", $page);
  showMenuItem('contact', "CONTACT", $page);
  showMenuItem('login', "LOGIN", $page);
  showMenuItem('register', "REGISTER", $page);
  showMenuItem('logout', "LOGOUT", $page);
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

function showMenuItem($linkParameter, $buttonLabel, $page) {
  echo '
    <li><a ';
      if ($page == $linkParameter) { echo 'class="active" '; }
      echo 'href="index.php?page=' . $linkParameter . '">' . $buttonLabel . '</a></li>
  ';
}
?>
