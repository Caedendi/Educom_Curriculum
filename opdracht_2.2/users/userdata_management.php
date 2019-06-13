<?php


function authoriseUser($email, $password) {

}

function isEmailKnown($email) {

}

function storeUser($name, $email, $password) {

}


function validateLogin($data) {
  if(empty($data)) { return false; }
  if(empty($data['email']) || empty($data['password'])) { return false; }
  ///// to do ///// verify existing account with file check
  else return true;
}

function validateRegister($data) {
  if(empty($data)) {  return false; }
  foreach ($data as $value) {
    if(empty($value)) {
      return false;
    }
  }
  unset($value);
  if ($data['password'] !== $data['passwordRepeat']) { return false; }
  return true;
}

?>
