<?php
function showFormStart($page) {
  echo '
    <!-- formfield -->
    <div class="formField">
      <p class="required">* Required field</p>
      <!-- displays error messages above form input fields if applicable -->
        <p class="errorMessage"></p>
      <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . /* je kan hier ook gewoon hardcoded index.php neerzetten */ '">
        <input class ="'. $page . '" type="hidden" name="page" value="' . $page . '"> <!-- to redirect back to current page instead of home -->
  '; /* JH: Bovenstaande hidden input heeft geen class nodig */
}

function showFormInput($type, $key, $labelText, $placeholder, $data, $rows=4, $columns=40) {
  echo '
    <div class="formRow">
      <label for="' . $key . '">' . $labelText . '</label>
  ';
  /* JH Extra: Voor het type 'password' zou ik graag om security technische redenen zien dat deze geen gevuld 'value' attribuut heeft */

  switch($type) {
    /* JH TIP: Om te voorkomen dat als je een nieuw type gaat gebruiken er helemaal geen <input> tag meer komt, zou ik onderstaande 3 cases vervangen door "default:" */
    case 'text':
    case 'email':
    case 'password':
      /* JH TIP: deze regels worden vrij lang, splits ze over meerdere regels */
      echo '
        <input class="' . getArrayValue($data, 'page') . '" type="' . $type . '" name="' . $key . '" id="' . $key . '" placeholder="' . $placeholder . '" value="'. getArrayValue($data, "$key" /* JH TIP: De $key hoeft niet tussen "" */) .'">
      ';
      break;
    case 'textarea':
      echo '
        <textarea class="' . getArrayValue($data, 'page') . '" name="' . $key . '" id="' . $key . '" placeholder="' . $placeholder . '" rows="' . $rows . '" cols="' . $columns . '">' . getArrayValue($data, "$key" /* JH TIP: De $key hoeft niet tussen "" */) . '</textarea>
      ';
      break;
  }

  echo '
      <span class="required"> * ' . getArrayValue($data, "{$key}Error" /* JH TIP: hoewel dit werkt zou ik het noteren als $key . "Error" */) . '</span>
    </div>
  ';
}

function showFormSubmit($submitButtonText) {
  echo '
    <!-- submit button -->
    <div class="formRow">
      <label for="submit"></label> <!-- empty label -->
      <input type="submit" value="' . $submitButtonText . '">
    </div>
  ';
}

function showFormEnd() {
  echo '
      </form>
    </div> <!-- end formfield -->
  ';
}
?>
