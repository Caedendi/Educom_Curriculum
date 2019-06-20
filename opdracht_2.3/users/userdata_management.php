<?php
/* JH: Als je commentaar boven een functie wilt zetten, gebruik dan doc-type style commentaar met /** alsvolgt:
/**
 * Validates the login form
 *
 * Checks that both input fields are filled and the passwords match with the database
 * @param array $data the array with data fields
 * @return array the modified data array
 */

 // valid when:
 //
 // * both input fields are filled
 // * emails and passwords match
function authenticateUser($email, $password) {
  $searchResult = findUserByEmailSql($email);
  if (empty($searchResult) || ($searchResult['password'] != $password)) {
    return NULL;
  }
  else if ($searchResult['email'] == $email
        && $searchResult['password'] == $password) {
    return array('name' => $searchResult['name'], 'valid' => true);
  }
  else return NULL;
}

// valid when:
//
// * no empty input values
// * email is not already registered
// * passwords match
function validateRegister($data) {/* JH: Deze code moet worden verplaatst naar een functie validateRegisterForm() in register.php */
  $data['valid'] = false;
  $isEmailKnown = isEmailKnown($data['email']);
  // if email already registered: only show email taken error
  if ($isEmailKnown) {
    $data['nameError'] = "";
    $data['emailError'] = "Email address already registered";
    $data['passwordError'] = "";
    $data['passwordRepeatError'] = "";
  }
  // if email not already registered and passwords are filled but dont match: show password match error
  /* JH: Onderstaande 2 tests zou moeten worden gedaan voordat de file wordt geraadpleegd (als er al een fout is gevonden moet de file helemaal niet benaderd worden) */
  else if (!empty($data['password']) && !empty($data['passwordRepeat']) && $data['password'] != $data['passwordRepeat']) {
    $data['passwordError'] = "Passwords do not match";
  }
  // success: all fields filled, email not already registered, passwords match
  else if ((!empty($data['name']) && !empty($data['email']) && !empty($data['password']) && !empty($data['passwordRepeat']))
      && (!$isEmailKnown) /* Hier wordt emailKnown voor de tweede keer aangeroepen dit geeft extra overhead */
      && ($data['password'] == $data['passwordRepeat'])) {
    $data['valid'] = true;
  }
  return $data;
}

// valid when all input fields are filled
function validateContactForm($data) {/* JH: Deze code moet worden verplaatst naar een functie validateContactForm() in contact.php */
  if (!empty($data['name']) && !empty($data['email']) && !empty($data['message'])) {
    $data['valid'] = true; }
  else $data['valid'] = false;
  return $data;
}

function storeUser($name, $email, $password) {
  if (empty(findUserByEmailSql($email))) {
    saveUserSql($name, $email, $password); }
  return; /* JH: Return is overbodig */
}

// implemented
function isEmailKnown($email) {
  if (empty($email)) return false;
  $searchResult = findUserByEmailSql($email);
  if (empty($searchResult)) {
    // echo 'user email not found';
    return false; }
  else return true;
}
?>
