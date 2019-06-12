<?php
function showRegisterContent() {
  echo '
    <div class="mainBody">
      <p>Register page.</p>
    </div>
    ';
}
?>





<!--
Optie 'Register' toont een scherm met Naam, Email-adres, Password input en herhaal Password input.

Wanneer registratie gepost, wordt email vergeleken met waardes uit bestand users\users.txt,
Wanneer niet aanwezig dan controleren of password en herhaal password gelijk zijn.
    Email al aanwezig of password ongelijk aan herhaal password dan foutmelding en formulier opnieuw tonen.
    Email niet aanwezig, voeg de gebruiker toe aan het bestand, en wordt de getoonde pagina de 'login' pagina.
-->
