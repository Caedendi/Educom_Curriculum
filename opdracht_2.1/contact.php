<?php
function showContactContent() {

  // business logic en show logic opdelen in functies
  // en derde functie validatie

  // ================================
  // business logic
  // ================================

  // define variables and set to empty values
  $nameError = $emailError = $messageError = "";
  $name = $email = $message = "";

  // tests form input data for security purposes
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // processes information provided in input fields.
  // if field is empty, an error message is made.
  // else it is tested for security purposes and stored
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // processes name
    if (empty($_POST["name"])) {
      $nameError = "Please provide a valid name";
    } else {
      $name = test_input($_POST["name"]);
    }

    // processes email address
    if (empty($_POST["email"])) {
      $emailError = "Please provide a valid email address";
    } else {
      $email = test_input($_POST["email"]);
    }

    // processes message
    if (empty($_POST["message"])) {
      $messageError = "Please type your message";
    } else {
      $message = test_input($_POST["message"]);
    }
  }

// ================================
// show logic
// ================================

echo '
    <!-- main site area -->
    <div class="mainBody">
      <!-- header -->
      <h1 class="header">Contact</h1>

      <p>Om contact met mij op te nemen, gelieve het onderstaande formulier in te vullen.</p>

      <!-- formfield -->
      <div class="formField">
        <p class="required">* Required field</p>
        <!-- displays error messages above form input fields if applicable -->
        <p class="errorMessage">
          ';
        //  if (!empty($nameError)) { echo $nameError; }
        //  if (!empty($emailError)) { echo $emailError; }
        //  if (!empty($messageError)) { echo $messageError; }
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

      <!-- Shows all entered input if input is correct -->
      <div class="belowForm">
        ';
        if (!empty($name) && !empty($email) && !empty($message)) {
          echo "<br><br>";
          echo "Bedankt voor uw bericht. Er zal zo snel mogelijk contact met u worden opgenomen.";
          echo "<br><br><br>";
          echo "Uw verstuurde gegevens: <br><br>";
          echo "Naam: " . $name;
          echo "<br>";
          echo "E-mail: " . $email;
          echo "<br>";
          echo "Bericht: ". $message;
          echo "<br>";
        }
        echo '
      </div>
    </div>

<!--
      // =============================================
      // PSD
      // ValidateInput
      // Valid ? show thanks : show contactform
      // =============================================
-->

  </body>
  ';
}
?>
