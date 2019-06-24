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
  // if either field is empty, show error
  if (empty($data['email']) || empty($data['password'])) {
    empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
    empty($data['password']) ? $data['passwordError'] = "Password required" : $data['passwordError'] = "";
  }
  else {
    try {
      $result = authenticateUserLogin($data['email'], $data['password']);
      if ($result) {
        $data['valid'] = $result['valid'];
        $data['name'] = $result['name'];
      }
      else {
        $data['emailError'] = "Incorrect email and/or password";
      }
    }
    catch(DatabaseConnectionException $e) {
      // echo 'Message: ' . $e->getMessage();
      throw $e;
    }
  }
  return $data;
}
?>
