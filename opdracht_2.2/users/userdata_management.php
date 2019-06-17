<?php
include 'userdata_source.php';

// implemented
//
// to do
//
// show filled login form (when false) or
// show home page (when success)
function validateLogin($data) {
  // print_r($data); echo '<br>'; // prints input data
  if(empty($data)) {
    return false; }
  if(empty($data['email']) || empty($data['password'])) {
    return false; }
  // include 'userdata_source.php';
  $searchResult = findUserByEmail($data['email']);
  if(empty($searchResult)) {
    // echo 'user email not found'; // used for debugging
    return false; }
  else if($searchResult['password'] != $data['password']) {
    // echo 'incorrect password<br>'; // used for debugging
    return false;
  }
  // echo 'success!'; // used for debugging
  $_SESSION['user_name'] = $searchResult['name'];
  $_SESSION['user'] = $data['email'];
  return true;
}

// to do
//
// show filled in register form (when false) or
// login and show home page (when success)
function validateRegister($data) {
  if(empty($data)) {
    return false; }
  if(empty($data['name']) || empty($data['email']) || empty($data['password']) || empty($data['email'])) {
    return false; }
  if ($data['password'] !== $data['passwordRepeat']) {
    return false; }
  // include 'userdata_source.php';
  if(isEmailKnown($data['email'])) {
    return false; }
  storeUser($data['name'], $data['email'], $data['password']);
  return true;
}

// to do
function storeUser($name, $email, $password) {
  if(!empty(findUserByEmail($email))) { return; }
  saveUser($name, $email, $password);
}

// implemented
function isEmailKnown($email) {
  // include 'userdata_source.php';
  $searchResult = findUserByEmail($email);
  if(empty($searchResult)) {
    // echo 'user email not found';
    return false; }
  else return true;
}
?>
