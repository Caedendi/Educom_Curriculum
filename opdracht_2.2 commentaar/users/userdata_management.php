<?php
// valid when:
//
// * both input fields are filled
// * emails and passwords match



/* JH: Als je commentaar boven een functie wilt zetten, gebruik dan doc-type style commentaar met /** alsvolgt:
/**
 * Validates the login form
 * 
 * Checks that both input fields are filled and the passwords match with the database 
 * @param array $data the array with data fields 
 * @return array the modified data array
 */
function validateLogin($data) { /* JH: Deze code moet deels worden verplaatst naar een functie validateLoginForm() in login.php
                                       Alleen de findUserByEmail en de password check zouden hier blijven in een functie authenticateUser($email, $password) die vanuit validateLoginForm wordt aangroepen als alle velden gevuld zijn  */
  if (!empty($data['email']) && !empty($data['password'])) {
    // find user data in datafile, then compare emails and passwords
    $searchResult = findUserByEmail($data['email']);
    if (empty($searchResult) || $searchResult['password'] != $data['password']) {
      $data['valid'] = false;
      $data['emailError'] = "Incorrect email and/or password";
    }
    else if ($searchResult['email'] == $data['email']
      && $searchResult['password'] == $data['password']) {
    $data['valid'] = true;
    $data['name'] = $searchResult['name'];
    }
  }
  else $data['valid'] = false;
  return $data;
}

// valid when:
//
// * no empty input values
// * email is not already registered
// * passwords match
function validateRegister($data) { /* JH: Deze code moet worden verplaatst naar een functie validateRegisterForm() in register.php */
  if (isEmailKnown($data['email'])) {
    $data['nameError'] = "";
    $data['emailError'] = "Email address already registered";
    $data['passwordError'] = "";
    $data['passwordRepeatError'] = "";
  }
  /* JH: Onderstaande 2 tests zou moeten worden gedaan voordat de file wordt geraadpleegd (als er al een fout is gevonden moet de file helemaal niet benaderd worden) */
  else if (!empty($data['password']) && !empty($data['passwordRepeat']) && $data['password'] != $data['passwordRepeat']) {
    $data['passwordError'] = "Passwords do not match";
  }
  if ((!empty($data['name']) && !empty($data['email']) && !empty($data['password']) && !empty($data['email']))
      && (!isEmailKnown($data['email'])) /* Hier wordt emailKnown voor de tweede keer aangeroepen dit geeft extra overhead */
      && ($data['password'] == $data['passwordRepeat'])) {
    $data['valid'] = true;
  }
  else $data['valid'] = false;
  return $data;
}

// valid when all input fields are filled
function validateContactForm($data) { /* JH: Deze code moet worden verplaatst naar een functie validateContactForm() in contact.php */
  if (!empty($data['name']) && !empty($data['email']) && !empty($data['message'])) {
    $data['valid'] = true; }
  else $data['valid'] = false;
  return $data;
}

function storeUser($name, $email, $password) {
  if (empty(findUserByEmail($email))) {
    saveUser($name, $email, $password); }
  return; /* JH: Return is overbodig */
}

// implemented
function isEmailKnown($email) {
  if (empty($email)) return false;
  $searchResult = findUserByEmail($email);
  if (empty($searchResult)) {
    // echo 'user email not found';
    return false; }
  else return true;
}
?>
