<!DOCTYPE html>
<html>
  <head>
    <title>Opdracht 1.3 Contact</title>
    <link rel="stylesheet" type="text/css" href="./css/FirstExternalSheet.css">
  </head>

  <body>
    <?php
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
    ?>

    <!-- header -->
    <h1>Contact</h1>

    <!-- navigation bar -->
    <div class="navbar">
      <ul>
       <li><a href="home.php">HOME</a></li>
       <li><a href="about.html">ABOUT</a></li>
       <li><a class="active" href="contact.php">CONTACT</a></li>
      </ul>
    </div>

    <!-- main site area -->
    <div class="mainBody">
      <p>Om contact met mij op te nemen, gelieve het onderstaande formulier in te vullen.</p>

      <!-- formfield -->
      <div class="formfield">
        <p class="required">* Required field</p>
        <!-- displays error messages above form input fields if applicable -->
        <p class="errormessage">
          <?php
          if (!empty($nameError)) { echo $nameError, "<br>"; }
          if (!empty($emailError)) { echo $emailError, "<br>"; }
          if (!empty($messageError)) { echo $messageError, "<br>"; }
          ?>
        </p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <!-- name -->
          <div class="formrow">
            <label for="naam">Naam:</label>
            <input type="text" name="name" placeholder="uw volledige naam" value="<?php echo $name;?>">
            <span> * </span>
          </div>
          <!-- email -->
          <div class="formrow">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="uw e-mailadres" value="<?php echo $email;?>">
            <span> * </span>
          </div>
          <!-- message -->
          <div class="formrow">
            <label for="bericht">Bericht:</label>
            <textarea name="message" placeholder="typ hier uw bericht" rows="10" cols="50"><?php
              if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea> <!-- remember text inside text area -->
              <span> * </span>
          </div>
          <!-- submit button -->
          <div class="formrow">
            <label for="submit"></label> <!-- empty label -->
            <input type="submit" value="Verstuur">
          </div>
        </form>
      </div> <!-- end formfield -->

      <!-- Shows all entered input if input is correct -->
      <div class="belowform">
        <?php
        if (!empty($name) && !empty($email) && !empty($message)) {
          echo "<br><br>";
          echo $name;
          echo "<br><br>";
          echo $email;
          echo "<br><br>";
          echo $message;
          echo "<br><br>";
        }
        ?>
      </div>
    </div>

    <!-- footer area -->
    <footer>
      <p>&copy; 2019 Bart Commandeur</p>
    </footer>
  </body>
</html>
