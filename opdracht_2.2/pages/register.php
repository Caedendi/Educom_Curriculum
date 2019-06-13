<?php


// Optie 'Register' toont een scherm met Naam, Email-adres, Password input en herhaal Password input.
//
// Wanneer registratie gepost, wordt email vergeleken met waardes uit bestand users\users.txt,
// Wanneer niet aanwezig dan controleren of password en herhaal password gelijk zijn.
//     Email al aanwezig of password ongelijk aan herhaal password dan foutmelding en formulier opnieuw tonen.
//     Email niet aanwezig, voeg de gebruiker toe aan het bestand, en wordt de getoonde pagina de 'login' pagina.




function showRegisterContent($data) {
  $data = array('name' => "", 'email' => "", 'password' => "", 'passwordRepeat' => "");
  $requestType = $_SERVER["REQUEST_METHOD"];
  if ($requestType == "POST") { // show either success message (when submitted info is valid) or partly filled formfield when invalid
    $name = test_input(getPostVar('name'));
    $email = test_input(getPostVar('email'));
    $password = test_input(getPostVar('password'));
    $passwordRepeat = test_input(getPostVar('passwordRepeat'));
    $data = array('name' => $name, 'email' => $email, 'password' => $password, 'passwordRepeat' => $passwordRepeat);
    $valid = validateRegister($data); // $name, $email, $password, $passwordRepeat);
    if($valid) { // show thanks + submitted info
      showRegisterSuccessful($data); // $name, $email, $password); ///////////////////////////////
    }
    else { // else show login field (partly filled)
      showRegisterField($data, false); // $name, $email, $password, $passwordRepeat);
    }
  }
  else { // if GET

    // foreach ($data as &$value) {
    //   $value = "";
    // }
    // unset($value);
    showRegisterField($data); // show register field (empty)
  }
}

function showRegisterSuccessful($data) {
  echo '
    <!-- Shows all entered input if input is correct -->
    <div class="mainBody">
      <p class="thanksMessage">Met succes geregistreerd.</p>
      <p class="thanksMessage">Uw naam:<br>
        Naam: ' . $data['name'] . '<br>
      <p class="thanksMessage">Uw emailadres:<br>
        E-mail: ' . $data['email'] . '<br>
      <p class="thanksMessage">Uw wachtwoord:<br>
        Password: ' . $data['password'] . '
    </div>
    ';
}

function showRegisterField($data, $newLogin=true) { //$name='', $email='', $password='', $passwordRepeat='') {
  $nameError = $emailError = $passwordError = $passwordRepeatError = "";
  if(!$newLogin) {
    if (empty($data['name'])) { $nameError = "Name required"; }
    if (empty($data['email'])) { $emailError = "Email address required"; }
    if (empty($data['password'])) { $passwordError = "Password required"; }
    if (empty($data['passwordRepeat'])) { $passwordRepeatError = "Verify password"; }
    if ($data['password'] !== $data['passwordRepeat']) { $passwordRepeatError = "Passwords do not match"; }
  }
  echo '
    <div class="mainBody"
      ' //<p>Inloggen maddafakkaaa</p>
      . '
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
            <span class="required"> * '.$nameError.'</span>
          </div>
          <div class="formRow">
            <label for="email">Emailadres:</label>
            <input class="register" type="text" name="email" id="email" placeholder="uw emailadres" value="'.$data['email'].'">
            <span class="required"> * '.$emailError.'</span>
          </div>
          <!-- email -->
          <div class="formRow">
            <label for="password">Wachtwoord:</label>
            <input class="register" type="password" name="password" id="password" placeholder="uw wachtwoord">
            <span class="required"> * '.$passwordError.'</span>
          </div>
          <div class="formRow">
            <label for="passwordRepeat">Herhaal wachtwoord:</label>
            <input class="register" type="password" name="passwordRepeat" id="passwordRepeat" placeholder="herhaal wachtwoord">
            <span class="required"> * '.$passwordRepeatError.'</span>
          </div>
          <!-- submit button -->
          <div class="formRow">
            <label for="submit"></label> <!-- empty label -->
            <input type="submit" value="Verstuur">
          </div>
        </form>
      </div> <!-- end register field -->
    </div> <!-- end mainBody -->
  ';
}



?>
