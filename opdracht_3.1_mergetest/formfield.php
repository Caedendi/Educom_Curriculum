<?php
function showForm($data) {
  showFormStart($data['page']);
  foreach ($data['form'] as $formItem) {
    showFormItem($formItem, $data);
  }
  showFormSubmit($data['submit']);
  showFormEnd();
}

function showFormStart($page) {
  echo '
    <div class="formField">
      <p class="required">* Required field</p>
        <p class="errorMessage"></p>
      <form method="post" action="index.php">
        <input type="hidden" name="page" value="' . $page . '"> <!-- to redirect back to current page instead of home -->
  ';
}

function showFormEnd() {
  echo '
      </form>
    </div> <!-- end formfield -->
  ';
}

function showFormItem($formItem, $data, $rows=10, $columns=50) {
  echo '
    <div class="formRow">
      <label for="' . $formItem['key'] . '">' . $formItem['label'] . '</label>
  ';

  switch($formItem['type']) {
    case 'password':
      echo '
        <input
          class="' . getArrayValue($data, 'page') . '"
          type="' . $formItem['type'] . '"
          name="' . $formItem['key'] . '"
          id="' . $formItem['key'] . '"
          placeholder="' . $formItem['placeholder'] . '"
        >
      ';
      break;
    case 'textarea':
      echo '
        <textarea
          class="' . getArrayValue($data, 'page') . '"
          name="' . $formItem['key'] . '"
          id="' . $formItem['key'] . '"
          placeholder="' . $formItem['placeholder'] . '"
          rows="' . $rows . '"
          cols="' . $columns . '"
        >' . getArrayValue($data, $formItem['key']) . '</textarea>
      ';
      break;
    default: // text; email. password is identical, but without a value variable
      echo '
        <input
          class="' . getArrayValue($data, 'page') . '"
          type="' . $formItem['type'] . '"
          name="' . $formItem['key'] . '"
          id="' . $formItem['key'] . '"
          placeholder="' . $formItem['placeholder'] . '"
          value="' . getArrayValue($data, $formItem['key']) . '"
        >
      ';
      break;
  }

  echo '
      <span class="required"> * ' . getArrayValue($data, $formItem['key'] . "Error") . '</span>
    </div>
  ';
}

function showFormSubmit($submitButtonText) {
  echo '
    <div class="formRow">
      <label for="submit"></label> ' /* empty label */ . '
      <input type="submit" value="' . $submitButtonText . '">
    </div>
  ';
}
?>
