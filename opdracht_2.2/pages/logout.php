<?php
function showLogoutContent() {
  echo '
    <div class="mainBody">
      <p>Logout page.</p>
    </div>
    ';


}

function logoutUser() {



  
  // remove all session variables
  session_unset();

  // destroy the session
  session_destroy();
}
?>





<!--
Wanneer login gepost, wordt email en password vergeleken met waardes uit bestand users\users.txt (zie formaat hieronder),
  wanneer aanwezig wordt de bijbehorende naam getoond in de menu-optie "Logout [NAAM]" en wordt de getoonde pagina de 'home' pagina,
-->
