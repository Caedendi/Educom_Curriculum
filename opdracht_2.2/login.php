<?php
function showLoginContent() {
  echo '
    <div class="mainBody">
      <p>Login page.</p>
    </div>
    ';
}
?>




<!--
Wanneer er geen ingelogde gebruiker is bevat het menu 2 extra opties: Login en Register.
  Optie 'Login' toont een scherm met Email-adres en password input.

Wanneer login gepost, wordt email en password vergeleken met waardes uit bestand users\users.txt (zie formaat hieronder),
  wanneer aanwezig wordt de bijbehorende naam getoond in de menu-optie "Logout [NAAM]" en wordt de getoonde pagina de 'home' pagina,
  anders foutmelding en opnieuw.
-->
