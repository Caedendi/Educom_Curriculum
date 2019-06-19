<?php
function showContactContent($data) {
  showFormField($data);
}

function showFormField($data) {
  echo '
    <!-- formfield -->
    <div class="formField">
      <p class="required">* Required field</p>
      <!-- displays error messages above form input fields if applicable -->
        <p class="errorMessage">
          ';
        /* JH Extra: Maak een functie getArrayVar($array, $key, $default='') zodat je hieronder kan doen getArrayVar($data, 'email') etc, dat scheelt allemaal lege waarden in de array zetten */
        echo '
        </p>
      <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
        <input class ="contact" type="hidden" name="page" value="contact"> <!-- to redirect back to contact page instead of home -->
        <!-- name -->
        <div class="formRow">
          <label for="name">Naam:</label>
          <input class="contact"type="text" name="name" id="name" placeholder="uw volledige naam" value="'.$data['name'].'">
          <span class="required"> * '. $data['nameError'] .'</span>
        </div>
        <!-- email -->
        <div class="formRow">
          <label for="email">Email:</label>
          <input class="contact" type="email" name="email" id="email" placeholder="uw e-mailadres" value="'.$data['email'].'">
          <span class="required"> * '.$data['emailError'] .'</span>
        </div>
        <!-- message -->
        <div class="formRow">
          <label for="message">Bericht:</label>
          <textarea class="contact" name="message" id="message" placeholder="typ hier uw bericht" rows="10" cols="50">' . $data['message'] . '</textarea> <!-- remember text inside text area -->
            <span class="required"> * '.$data['messageError'] .'</span>
        </div>
        <!-- submit button -->
        <div class="formRow">
          <label for="submit"></label> <!-- empty label -->
          <input type="submit" value="Verstuur">
        </div>
      </form>
    </div> <!-- end formfield -->
  ';
  /* JH Extra: Je ziet dat er veel herhaling is in de code hierboven. Maak een functie showFormInput($key, $labelText, $type, $placeholder, $data, $rows=4, $cols=40) en zet hier neer:
               showFormStart($data['page']);
               showFormInput('name', 'Naam:', 'text', 'uw naam', $data);
               showFormInput('email', 'Emailadres:', 'email', 'uw emailadres', $data);
               showFormInput('message', 'Wachtwoord:', 'testarea', 'type hier uw bericht', $data, 10, 50);
               showFormEnd('Verstuur');
  */
}
?>
