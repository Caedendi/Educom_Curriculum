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
 function authenticateUserLogin($email, $password) {
   $searchResult = findUserByEmail($email);
   if (empty($searchResult) || ($searchResult['password'] != $password) || empty($searchResult['name'])) {
     return NULL;
   }
   else {
     $result = array(
       'id' => $searchResult['id'],
       'name' => $searchResult['name'],
       'email' => $searchResult['email']
     );
     return $result;
   }
 }

function storeUser($name, $email, $password) {
  if (empty(findUserByEmail($email))) {
    saveUser($name, $email, $password); }
}

function isEmailKnown($email) {
  if (empty($email)) return false;
  $searchResult = findUserByEmail($email);
  if (empty($searchResult)) {
    return false; }
  else return true;
}
?>
