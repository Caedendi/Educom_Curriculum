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

// valid when all input fields are filled
function validateContactForm($data) {/* JH: Deze code moet worden verplaatst naar een functie validateContactForm() in contact.php */
  if (!empty($data['name']) && !empty($data['email']) && !empty($data['message'])) {
    $data['valid'] = true; }
  else $data['valid'] = false;
  return $data;
}

function storeUser($name, $email, $password) {
  if (empty(findUserByEmailSql($email))) {
    saveUserSql($name, $email, $password); }
  return; /* JH: Return is overbodig */
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
