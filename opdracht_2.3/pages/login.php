<?php
function showLoginContent($data) {
  showLoginForm($data);
}

function showLoginForm($data) {
  showFormStart($data['page']);
  showFormInput('email', 'email', 'Email:', 'uw emailadres', $data);
  showFormInput('password', 'password', 'Wachtwoord:', 'uw wachtwoord', $data);
  showFormSubmit("Verstuur");
  showFormEnd();
}

function validateLoginForm($data) {
  $data['email'] = testInput(getPostValue('email'));
  $data['password'] = testInput(getPostValue('password'));
  $data['valid'] = false;
  if (!empty($data['email']) && !empty($data['password'])) { // als alle velden ingevuld, doe authenticatie
    $result = authenticateUser($data['email'], $data['password']);
    if ($result) {
      $data['valid'] = $result['valid'];
      $data['name'] = $result['name'];
    }
    else {
      $data['emailError'] = "Incorrect email and/or password";
    }
  }
  else { // if email = empty or password = empty
    empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
    empty($data['password']) ? $data['passwordError'] = "Password required" : $data['passwordError'] = "";
  }
  return $data;
}
?>
