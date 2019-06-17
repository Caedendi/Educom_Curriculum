<?php
function showRegisterContent($data) {
  showRegisterField($data);
}

function showRegisterSuccessful($data) { // wordt niet meer gebruikt
  echo '
    <!-- Shows all entered input if input is correct -->
    <p class="thanksMessage">Met succes geregistreerd.</p>
    <p class="thanksMessage">Uw naam:<br>
      Naam: ' . $data['name'] . '<br>
    <p class="thanksMessage">Uw emailadres:<br>
      E-mail: ' . $data['email'] . '<br>
    <p class="thanksMessage">Uw wachtwoord:<br>
      Password: ' . $data['password'] . '
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
          <span class="required"> * '. $data['nameError'] .'</span>
        </div>
        <div class="formRow">
          <label for="email">Emailadres:</label>
          <input class="register" type="text" name="email" id="email" placeholder="uw emailadres" value="'.$data['email'].'">
          <span class="required"> * '. $data['emailError'] .'</span>
        </div>
        <!-- email -->
        <div class="formRow">
          <label for="password">Wachtwoord:</label>
          <input class="register" type="password" name="password" id="password" placeholder="uw wachtwoord">
          <span class="required"> * '. $data['passwordError'] .'</span>
        </div>
        <div class="formRow">
          <label for="passwordRepeat">Herhaal wachtwoord:</label>
          <input class="register" type="password" name="passwordRepeat" id="passwordRepeat" placeholder="herhaal wachtwoord">
          <span class="required"> * '. $data['passwordRepeatError'] .'</span>
        </div>
        <!-- submit button -->
        <div class="formRow">
          <label for="submit"></label> <!-- empty label -->
          <input type="submit" value="Verstuur">
        </div>
      </form>
    </div> <!-- end register field -->
  ';
}



?>
