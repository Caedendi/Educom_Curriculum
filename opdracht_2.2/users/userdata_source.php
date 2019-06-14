<?php

// implemented
//
// scans /users.txt for existing email (input).
// found? return data (array w/ name, email, password).
// not found? return empty variable.
function findUserByEmail($email) {
  $userData = "";
  $userDataFile = fopen(__DIR__ . "/users.txt", "r") or die("findUserByEmail() can not open users.txt");
  fgets($userDataFile); // skip first line
  while(!feof($userDataFile)) {
    $currentUser = explode("|", fgets($userDataFile));
    // print_r($currentUser); echo '<br>';
    if($currentUser[0] == $email) {
      $userData = array('name' => $currentUser[1], 'email' => $currentUser[0], 'password' => $currentUser[2]);
      break;
    }
  }
  fclose($userDataFile);
  return $userData;
}

// to do
//
// saves input user data to file.
// does not check if email already exists.
function saveUser($name, $email, $password) {
  $userDataFile = fopen(__DIR__ . "/users.txt", "a") or die("saveUser() can not open users.txt");
  $newUser = PHP_EOL . $email . "|" . $name . "|" . $password;
  fwrite($userDataFile, $newUser);
  fclose($userDataFile);
}

// to do
function deleteUser($email) {

}


?>
