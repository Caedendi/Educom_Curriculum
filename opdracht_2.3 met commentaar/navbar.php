<?php
function showMenu($page) {
  showMenuStart();
  /* JH Extra: Je ziet dat onderstaande code een patroon begint te krijgen van {inializatie}, herhalen van iets en {afsluiting}. 
               Als je dit ziet, kan je er over denken om een lijst van meta data te maken bijvoorbeeld wat je per menuitem wil opslaan 
               en dan hier met een for-each lus door ieder van die meta data te gaan.
               Zie ook opmerking in index.php op regel 85

               showMenuStart();
               for($data['menu'] as $menuItem) {
                 showMenuItem($menuItem, $page);
               }
               showMenuEnd();

               Misschien zie je dit patroon nog op een andere plaats in de code?
  */

  showMenuItem('home', "HOME", "regularPage", $page);
  showMenuItem('about', "ABOUT", "regularPage", $page);
  showMenuItem('contact', "CONTACT", "regularPage", $page);
  /* JH: Zie opmerking in debug.php. Het is niet de bedoeling om debug code in productie code te plaatsen */
  if (DEBUG_TEST_PAGE) { showMenuItem('debug', "DEBUG", "regularPage", $page); }
  if (isUserLoggedIn()) {
    showMenuItem('logout', "LOGOUT [" . explode(' ', $_SESSION['userName'])[0] /* JH: Plaats deze code in een functie "getLoggedInUserFirstName" in de session_manager */. "]", "logout", $page); // shows logged in user's first name on logout button
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
  /* JH: TIP de width in de navButtonClass gaat je later nog in de problemen geven,
        beter om de brouwser die te laten bepalen en hier alleen een class toevoegen
        voor de buttons die rechts moeten worden uitgelijnd */
  // nog niet naar gekeken
}
?>
