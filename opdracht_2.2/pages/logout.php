<?php
function showLogoutContent() {
  echo '
    <p>Logout page.</p>
    <p>You have been logged out.</p>
  ';
  session_destroy();
}
?>





<!--
Wanneer login gepost, wordt email en password vergeleken met waardes uit bestand users\users.txt (zie formaat hieronder),
  wanneer aanwezig wordt de bijbehorende naam getoond in de menu-optie "Logout [NAAM]" en wordt de getoonde pagina de 'home' pagina,
-->
