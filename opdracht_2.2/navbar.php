<?php
function showMenu($page) {
  showMenuStart();
  showMenuItem('home', "HOME", "regularPage", $page);
  showMenuItem('about', "ABOUT", "regularPage", $page);
  showMenuItem('contact', "CONTACT", "regularPage", $page);
  if( isset($_SESSION['user'])) {
    $firstName = substr($_SESSION['user_name'], 0, strpos($_SESSION['user_name'], " "));
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
}
?>
