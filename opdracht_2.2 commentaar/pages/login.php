<?php
function showLoginContent($data) {
  showLoginField($data);
}

function showLoginField($data) {
  echo '
    <!-- formfield -->
    <div class="loginField">
      <p class="required">* Required field</p>
      <p class="errorMessage">
        ';
      /* JH Extra: Maak een functie getArrayVar($array, $key, $default='') zodat je hieronder kan doen getArrayVar($data, 'email') etc, dat scheelt allemaal lege waarden in de array zetten */
      echo '
      </p>
      <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
        <input class="login" type="hidden" name="page" value="login"> <!-- to redirect back to login page instead of home -->
        <!-- name -->
        <div class="formRow">
          <label for="email">Emailadres:</label>
          <input class="login" type="email" name="email" id="email" placeholder="uw emailadres" value="'.$data['email'].'">
          <span class="required"> * '. $data['emailError'] . '</span>
        </div>
        <!-- email -->
        <div class="formRow">
          <label for="password">Password:</label>
          <input class="login" type="password" name="password" id="password" placeholder="uw wachtwoord">
          <span class="required"> * '. $data['passwordError'] .'</span>
        </div>
        <!-- submit button -->
        <div class="formRow">
          <label for="submit"></label> <!-- empty label -->
          <input type="submit" value="Verstuur">
        </div>
      </form>
    </div> <!-- end loginfield -->
  ';
  /* JH Extra: Je ziet dat er veel herhaling is in de code hierboven. Maak een functie showFormInput($key, $labelText, $type, $placeholder, $data, $rows=4, $cols=40) en zet hier neer:
               showFormStart($data['page']);
               showFormInput('email', 'Emailadres:', 'email', 'uw emailadres', $data);
               showFormInput('password', 'Wachtwoord:', 'password', 'uw wachtwoord', $data);
               showFormEnd('Verstuur');
  */
}
?>
