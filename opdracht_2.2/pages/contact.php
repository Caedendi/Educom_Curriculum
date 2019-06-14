<?php

function showContactContent() {
  $data = array(
    'name' => "",
    'email' => "",
    'message' => "",
    'valid' => false,
    'nameError' => "",
    'emailError' => "",
    'messageError' => ""
  );
  $requestType = $_SERVER["REQUEST_METHOD"];
  // POST: show either thanks message (when submitted info is valid) or partly filled formfield when invalid
  if ($requestType == "POST") { //
    $data = validateContactForm($data);
    if ($data['valid']) { // show thanks message + submitted info
      showThanks($data); }
    else { // show contact form (partly filled & error messages)
      showFormField($data); }
  }
  // GET: // show contact form (empty)
  else if ($requestType == "GET") {
    showFormField($data);
  }
  /*
  ik weet dat de code hier dubbelop is, maar naar mijn idee is de logica
  zo beter afgebakend.
  */
}

function validateContactForm($data) {
  // get all post values. for all values:
  // * test input
  // * if empty, create error message
  // * else store value
  $name = test_input(getPostVar('name'));
  $email = test_input(getPostVar('email'));
  $message = test_input(getPostVar('message'));
  if (empty($name)) { $data['nameError'] = "Name required"; }
  else { $data['name'] = $name; }
  if (empty($email)) { $data['emailError'] = "Email address required"; }
  else { $data['email'] = $email; }
  if (empty($message)) { $data['messageError'] = "Please type your message"; }
  else { $data['message'] = $message; }

  // if none are empty, data is valid
  if (!empty($data['name']) && !empty($data['email']) && !empty($data['message'])) {
    $data['valid'] = true; }
  else { $data['valid'] = false; }
  return $data;
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

function showFormField($data) {
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
          <span class="required"> * '.$data['nameError'] .'</span>
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
}
?>
