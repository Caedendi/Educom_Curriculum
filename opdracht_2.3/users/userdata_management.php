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
  try {
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
  catch(Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
}

function storeUser($name, $email, $password) {
  if (empty(findUserByEmailSql($email))) {
    saveUserToDatabase($name, $email, $password); }
}

// implemented
function isEmailKnown($email) {
  if (empty($email)) return false;
  $searchResult = findUserByEmailSql($email);
  if (empty($searchResult)) {
    return false; }
  else return true;
}
?>
