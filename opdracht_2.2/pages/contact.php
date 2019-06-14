<?php

function showContactContent() {
  $data = array('name' => "", 'email' => "", 'message' => "");
  $requestType = $_SERVER["REQUEST_METHOD"];
  if ($requestType == "POST") { // show either thanks message (when submitted info is valid) or partly filled formfield when invalid
    $name = test_input(getPostVar('name'));
    $email = test_input(getPostVar('email'));
    $message = test_input(getPostVar('message'));
    $data = array('name' => $name, 'email' => $email, 'message' => $message);
    $valid = validateContactForm($data);
    if($valid) { // show thanks + submitted info
      showThanks($data);
    }
    else { // else show contact form (partly filled)
      showFormField($data, false);
    }
  }
  else { // if GET
    showFormField($data); // show contact form (empty)
  }
}

function validateContactForm($data) {
  foreach ($data as $value) {
    if(empty($value)) { return false; }
  }
  return true;
}

function showThanks($data) {
  echo '
    <!-- Shows all entered input if input is correct -->
    <p class="thanksMessage">Bedankt voor uw bericht. Er zal zo spoedig mogelijk contact met u worden opgenomen.</p>
    <p class="thanksMessage">Uw verstuurde gegevens:<br>
      Naam: ' . $data['name'] . '<br>
      E-mail: ' . $data['email'] . '<br>
      Bericht: ' . $data['message'] . '
  ';
}

function showFormField($data, $newForm=true) {
  $nameError = $emailError = $messageError = "";
  if(!$newForm) {
    if (empty($data['name'])) { $nameError = "Name required"; }
    if (empty($data['email'])) { $emailError = "Email address required"; }
    if (empty($data['message'])) { $messageError = "Please type your message"; }
  }
  echo '
    <!-- formfield -->
    <div class="formField">
      <p class="required">* Required field</p>
      <!-- displays error messages above form input fields if applicable -->
        <p class="errorMessage">
          ';
        echo '
        </p>
      <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
        <input class ="contact" type="hidden" name="page" value="contact"> <!-- to redirect back to contact page instead of home -->
        <!-- name -->
        <div class="formRow">
          <label for="name">Naam:</label>
          <input class="contact"type="text" name="name" id="name" placeholder="uw volledige naam" value="'.$data['name'].'">
          <span class="required"> * '.$nameError.'</span>
        </div>
        <!-- email -->
        <div class="formRow">
          <label for="email">Email:</label>
          <input class="contact" type="email" name="email" id="email" placeholder="uw e-mailadres" value="'.$data['email'].'">
          <span class="required"> * '.$emailError.'</span>
        </div>
        <!-- message -->
        <div class="formRow">
          <label for="message">Bericht:</label>
          <textarea class="contact" name="message" id="message" placeholder="typ hier uw bericht" rows="10" cols="50">';
            if(isset($data['message'])) { echo $data['message']; } echo '</textarea> <!-- remember text inside text area -->
            <span class="required"> * '.$messageError.'</span>
        </div>
        <!-- submit button -->
        <div class="formRow">
          <label for="submit"></label> <!-- empty label -->
          <input type="submit" value="Verstuur">
        </div>
      </form>
    </div> <!-- end formfield -->
  ';
}
?>
