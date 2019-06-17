<?php
// valid when:
//
// * both input fields are filled
// * emails and passwords match
function validateLogin($data) {
  if (!empty($data['email']) && !empty($data['password'])) {
    // find user data in datafile, then compare emails and passwords
    $searchResult = findUserByEmail($data['email']);
    if ($searchResult['email'] == $data['email']
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
  if ((!empty($data['name']) && !empty($data['email']) && !empty($data['password']) && !empty($data['email']))
      && (!isEmailKnown($data['email']))
      && ($data['password'] == $data['passwordRepeat'])) {
    $data['valid'] = true;
  }
  else $data['valid'] = false;
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
  if (empty(findUserByEmail($email))) {
    saveUser($name, $email, $password); }
  return;
}

// implemented
function isEmailKnown($email) {
  $searchResult = findUserByEmail($email);
  if (empty($searchResult)) {
    // echo 'user email not found';
    return false; }
  else return true;
}
?>
