<?php
// valid when:
//
// * both input fields are filled
// * emails and passwords match
function validateLogin($data) {
  if (!empty($data['email']) && !empty($data['password'])) {
    // find user data in datafile, then compare emails and passwords
    $searchResult = findUserByEmailSql($data['email']);
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
function validateRegister($data) {
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
  else if (!empty($data['password']) && !empty($data['passwordRepeat']) && $data['password'] != $data['passwordRepeat']) {
    $data['passwordError'] = "Passwords do not match";
  }
  // success: all fields filled, email not already registered, passwords match
  else if ((!empty($data['name']) && !empty($data['email']) && !empty($data['password']) && !empty($data['passwordRepeat']))
      && (!$isEmailKnown)
      && ($data['password'] == $data['passwordRepeat'])) {
    $data['valid'] = true;
  }
  return $data;
}

// valid when all input fields are filled
function validateContactForm($data) {
  if (!empty($data['name']) && !empty($data['email']) && !empty($data['message'])) {
    $data['valid'] = true; }
  else $data['valid'] = false;
  return $data;
}

function storeUser($name, $email, $password) {
  if (empty(findUserByEmailSql($email))) {
    saveUserSql($name, $email, $password); }
  return;
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
