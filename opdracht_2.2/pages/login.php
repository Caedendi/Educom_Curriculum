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
}
?>
