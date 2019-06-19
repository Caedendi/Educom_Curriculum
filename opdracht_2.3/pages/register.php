<?php
function showRegisterContent($data) {
  showRegisterField($data);
}

function showRegisterSuccessful($data) { // wordt niet meer gebruikt
  echo '
    <!-- Shows all entered input if input is correct -->
    <p class="thanksMessage">Met succes geregistreerd.</p>
    <p class="thanksMessage">Uw naam:<br>
      Naam: ' . getArrayVar($data, "name") . '<br>
    <p class="thanksMessage">Uw emailadres:<br>
      E-mail: ' . getArrayVar($data, "email") . '<br>
    <p class="thanksMessage">Uw wachtwoord:<br>
      Password: ' . getArrayVar($data, "password") . '
  ';
}

function showRegisterField($data) {
  echo '
    <!-- register field -->
    <div class="registerField">
      <p class="required">* Required field</p>
      <p class="errorMessage">
        ';
      echo '
      </p>
      <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
        <input class="register" type="hidden" name="page" value="register"> <!-- to redirect back to contact page instead of home -->
        <!-- name -->
        <div class="formRow">
          <label for="name">Naam:</label>
          <input class="register" type="text" name="name" id="name" placeholder="uw naam" value="'.$data['name'].'">
          <span class="required"> * '. getArrayVar($data, "nameError") .'</span>
        </div>
        <div class="formRow">
          <label for="email">Emailadres:</label>
          <input class="register" type="text" name="email" id="email" placeholder="uw emailadres" value="'.$data['email'].'">
          <span class="required"> * '. getArrayVar($data, "emailError") .'</span>
        </div>
        <!-- email -->
        <div class="formRow">
          <label for="password">Wachtwoord:</label>
          <input class="register" type="password" name="password" id="password" placeholder="uw wachtwoord">
          <span class="required"> * '. getArrayVar($data, "passwordError") .'</span>
        </div>
        <div class="formRow">
          <label for="passwordRepeat">Herhaal wachtwoord:</label>
          <input class="register" type="password" name="passwordRepeat" id="passwordRepeat" placeholder="herhaal wachtwoord">
          <span class="required"> * '. getArrayVar($data, "passwordRepeatError") .'</span>
        </div>
        <!-- submit button -->
        <div class="formRow">
          <label for="submit"></label> <!-- empty label -->
          <input type="submit" value="Verstuur">
        </div>
      </form>
    </div> <!-- end register field -->
  ';
  /* JH Extra: Je ziet dat er veel herhaling is in de code hierboven. Maak een functie showFormInput($key, $labelText, $type, $placeholder, $data, $rows=4, $cols=40) en zet hier neer:
               showFormStart($data['page']);
               showFormInput('name', 'Naam:', 'text', 'uw naam', $data);
               showFormInput('email', 'Emailadres:', 'email', 'uw emailadres', $data);
               showFormInput('password', 'Wachtwoord:', 'password', 'uw wachtwoord', $data);
               showFormInput('passwordRepeat', 'Herhaal wachtwoord:', 'password', 'herhaal wachtwoord', $data);
               showFormEnd('Verstuur');
  */
}



?>
