<?php


function authoriseUser($email, $password) {

}

function isEmailKnown($email) {

}

function storeUser($name, $email, $password) {

}






function validateLogin($data) {
  // print_r($data); echo '<br>'; // prints input data
  if(empty($data)) {
    return false; }
  if(empty($data['email']) || empty($data['password'])) {
    return false; }
  include 'userdata_source.php';
  $searchResult = findUserByEmail($data['email']);
  if(empty($searchResult)) {
    echo 'user email not found';
    return false; }
  else if($searchResult['password'] != $data['password']) {
    echo 'incorrect pass<br>';
    return false;
  }
  echo 'success!';
  return true;
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
