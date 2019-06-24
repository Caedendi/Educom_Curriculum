<?php
function showFormStart($page) {
  echo '
    <!-- formfield -->
    <div class="formField">
      <p class="required">* Required field</p>
      <!-- displays error messages above form input fields if applicable -->
        <p class="errorMessage"></p>
      <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
        <input class ="'. $page . '" type="hidden" name="page" value="' . $page . '"> <!-- to redirect back to current page instead of home -->
  ';
}

function showFormInput($type, $key, $labelText, $placeholder, $data, $rows=4, $columns=40) {
  echo '
    <div class="formRow">
      <label for="' . $key . '">' . $labelText . '</label>
  ';

  switch($type) {
    case 'text':
    case 'email':
    case 'password':
      echo '
        <input class="' . getArrayValue($data, 'page') . '" type="' . $type . '" name="' . $key . '" id="' . $key . '" placeholder="' . $placeholder . '" value="'. getArrayValue($data, "$key") .'">
      ';
      break;
    case 'textarea':
      echo '
        <textarea class="' . getArrayValue($data, 'page') . '" name="' . $key . '" id="' . $key . '" placeholder="' . $placeholder . '" rows="' . $rows . '" cols="' . $columns . '">' . getArrayValue($data, "$key") . '</textarea>
      ';
      break;
  }

  echo '
      <span class="required"> * ' . getArrayValue($data, "{$key}Error") . '</span>
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
