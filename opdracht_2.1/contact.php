<?php

function validateContactForm() {
  $name = getPostVar('name');
  $email = getPostVar('email');
  $message = getPostVar('message');
  $valid = (!empty($name) && !empty($email) && !empty($message));
  return $valid;
}

// tests form input data for security purposes
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function showContactContent() {
  $requestType = $_SERVER["REQUEST_METHOD"];
  if ($requestType == "POST") {
    $name = test_input(getPostVar('name'));
    $email = test_input(getPostVar('email'));
    $message = test_input(getPostVar('message'));
    $valid = validateContactForm();
    if($valid) {
      showThanks($name, $email, $message);
    }
    else { // else show contact form (partly filled)
      showFormField(false, $name, $email, $message);
    }
  }
  else { // if GET
    // show contact form (empty)
    showFormField();
  }
}

function showFormField($newForm=true, $name='', $email='', $message='') {
  $nameError = $emailError = $messageError = "";
  if(!$newForm) {
    if (empty($name)) { $nameError = "Name required"; }
    if (empty($email)) { $emailError = "Email address required"; }
    if (empty($message)) { $messageError = "Please type your message"; }
  }
  echo '
    <div class="mainBody"
      <p>Om contact met mij op te nemen, gelieve het onderstaande formulier in te vullen.</p>

      <!-- formfield -->
      <div class="formField">
        <p class="required">* Required field</p>
        <!-- displays error messages above form input fields if applicable -->
        <p class="errorMessage">
          ';
        echo '
        </p>
        <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
          <input type="hidden" name="page" value="contact"> <!-- to redirect back to contact page instead of home -->
          <!-- name -->
          <div class="formRow">
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name" placeholder="uw volledige naam" value="'.$name.'">
            <span class="required"> * '.$nameError.'</span>
          </div>
          <!-- email -->
          <div class="formRow">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="uw e-mailadres" value="'.$email.'">
            <span class="required"> * '.$emailError.'</span>
          </div>
          <!-- message -->
          <div class="formRow">
            <label for="message">Bericht:</label>
            <textarea name="message" id="message" placeholder="typ hier uw bericht" rows="10" cols="50">';
              if(isset($message)) { echo $message; } echo '</textarea> <!-- remember text inside text area -->
              <span class="required"> * '.$messageError.'</span>
          </div>
          <!-- submit button -->
          <div class="formRow">
            <label for="submit"></label> <!-- empty label -->
            <input type="submit" value="Verstuur">
          </div>
        </form>
      </div> <!-- end formfield -->
    </div> <!-- end mainBody -->
  ';
}

function showThanks($name, $email, $message) {
  echo '
    <!-- Shows all entered input if input is correct -->
    <div class="mainBody">
      <p class="thanksMessage">Bedankt voor uw bericht. Er zal zo spoedig mogelijk contact met u worden opgenomen.</p>
      <p class="thanksMessage">Uw verstuurde gegevens:<br>
        Naam: ' . $name . '<br>
        E-mail: ' . $email . '<br>
        Bericht: ' . $message . '
    </div>
    ';
}
?>
