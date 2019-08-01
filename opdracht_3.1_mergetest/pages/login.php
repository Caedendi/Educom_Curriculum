<?php
include_once 'formfield.php';

function showLoginContent($data) {
  showForm($data);
}

function processLoginPage($data) {
  try {
    $data = validateLoginForm($data);
    if($data['valid']) { // login user, show home page
      loginUser($data['id'], $data['name'], $data['email']);
      $data['page'] = "home";
    }
  }
  catch(DatabaseConnectionException $e) {
    $data['page'] = "technical_error";
  }
  return $data;
}

function validateLoginForm($data) {
  $data['email'] = testInput(getPostValue('email'));
  $data['password'] = testInput(getPostValue('password'));
  $data['valid'] = false;

  // if either field is empty, an error message will be shown
  empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
  empty($data['password']) ? $data['passwordError'] = "Password required" : $data['passwordError'] = "";

  // authentication will only happen if there are no error messages
  if (empty($data['emailError']) && empty($data['passwordError'])) {
    try {
      $result = authenticateUserLogin($data['email'], $data['password']);
      if ($result) {
        $data['id'] = $result['id'];
        $data['name'] = $result['name'];
        $data['valid'] = true;
      }
      else {
        $data['emailError'] = "Incorrect email and/or password";
      }
    }
    catch(DatabaseConnectionException $e) {
      // TODO
      // echo 'Message: ' . $e->getMessage();
      /* JH: Als je hier niets met de excptie doet, kan je beter de try en catch weghalen */
      throw $e;
    }
  }

  return $data;
}
?>
