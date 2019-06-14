<?php


// Wanneer er geen ingelogde gebruiker is bevat het menu 2 extra opties: Login en Register.
//   Optie 'Login' toont een scherm met Email-adres en password input.
//
// Wanneer login gepost, wordt email en password vergeleken met waardes uit bestand users\users.txt (zie formaat hieronder),
//   wanneer aanwezig wordt de bijbehorende naam getoond in de menu-optie "Logout [NAAM]" en wordt de getoonde pagina de 'home' pagina,
//   anders foutmelding en opnieuw.




function showLoginContent($data) {
  $data = array('email' => "", 'password' => "");
  $requestType = $_SERVER["REQUEST_METHOD"];
  if ($requestType == "POST") { // show either success message (when submitted info is valid) or partly filled formfield when invalid
    $email = test_input(getPostVar('email'));
    $password = test_input(getPostVar('password'));
    $data = array('email' => $email, 'password' => $password);
    include './users/userdata_management.php';
    $valid = validateLogin($data);
    if($valid) { // show thanks + submitted info
      showLoginSuccessful($data); ///////////////////////////////
      ///// to do ///// log user in
      ///// to do ///// show homepage
    }
    else { // else show login field (partly filled)
      showLoginField($data, false);
    }
  }
  else { // if GET
    showLoginField($data); // show login field (empty)
  }
}

function showLoginSuccessful($data) {
  echo '
    <!-- Shows all entered input if input is correct -->
    <p class="thanksMessage">Met succes ingelogd.</p>
    <p class="thanksMessage">Uw emailadres:<br>
      E-mail: ' . $data['email'] . '<br>
      Password: ' . $data['password'] . '
  ';
}

function showLoginField($data, $newLogin=true) {
  $emailError = $passwordError = "";
  if(!$newLogin) {
    if (empty($data['email'])) { $emailError = "Email address required"; }
    if (empty($data['password'])) { $passwordError = "Password required"; }
  }
  echo '
    <!-- formfield -->
    <div class="loginField">
      <p class="required">* Required field</p>
      <p class="errorMessage">
        ';
      echo '
      </p>
      <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
        <input class="login" type="hidden" name="page" value="login"> <!-- to redirect back to contact page instead of home -->
        <!-- name -->
        <div class="formRow">
          <label for="email">Emailadres:</label>
          <input class="login" type="email" name="email" id="email" placeholder="uw emailadres" value="'.$data['email'].'">
          <span class="required"> * '.$emailError.'</span>
        </div>
        <!-- email -->
        <div class="formRow">
          <label for="password">Password:</label>
          <input class="login" type="password" name="password" id="password" placeholder="uw wachtwoord">
          <span class="required"> * '.$passwordError.'</span>
        </div>
        <!-- submit button -->
        <div class="formRow">
          <label for="submit"></label> <!-- empty label -->
          <input type="submit" value="Verstuur">
        </div>
      </form>
    </div> <!-- end loginfield -->
  ';
}



?>
