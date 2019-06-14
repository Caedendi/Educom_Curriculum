<?php


// scans /users.txt for existing email (input).
// found? return data (array w/ name, email, password).
// not found? return empty variable.
function findUserByEmail($email) {
  $userData = "";
  $userDataFile = fopen(__DIR__ . "/users.txt", "r") or die("Can not open users.txt");
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

function saveUser($name, $email, $password) {

}

function deleteUser($email) {

}


?>
