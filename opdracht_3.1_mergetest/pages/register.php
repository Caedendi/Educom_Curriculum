<?php
include_once 'formfield.php';

function showRegisterContent($data) {
  showPreRegisterForm();
  showForm($data);
}

function processRegisterPage($data) {
  try {
    $data = validateRegisterForm($data);
    if($data['valid']) { // store new user, show login page
      storeUser($data['name'], $data['email'], $data['password']);
      $data['page'] = "login";
    }
  }
  catch(DatabaseConnectionException $e) {
    $data['page'] = "technical_error";
  }
  return $data;
}

function showPreRegisterForm() {
  echo '
    <p>Wat leuk dat u zich wilt registreren op deze website!</p>
    <p>Vul hieronder uw gegevens in en druk op verstuur. U kunt vervolgens
        inloggen met uw zojuist gemaakte account.</p>
    <p>' . LOREM_IPSUM . '</p>
  ';
}

function validateRegisterForm($data) {
  $data['name'] = testInput(getPostValue('name'));
  $data['email'] = testInput(getPostValue('email'));
  $data['password'] = testInput(getPostValue('password'));
  $data['passwordRepeat'] = testInput(getPostValue('passwordRepeat'));
  $data['valid'] = false;

  empty($data['name']) ? $data['nameError'] = "Name required" : $data['nameError'] = "";
  empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
  empty($data['password']) ? $data['passwordError'] = "Password required" : $data['passwordError'] = "";
  empty($data['passwordRepeat']) ? $data['passwordRepeatError'] = "Please repeat password" : $data['passwordRepeatError'] = "";

  if ($data['password'] != $data['passwordRepeat']) {
    $data['passwordError'] = "Passwords do not match";
  }

  // if all fields filled & passwords match, then check if email already registered
  // yes? show register error
  // no? set register is valid
  else if ((empty($data['nameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['passwordRepeatError']))
        && ($data['password'] == $data['passwordRepeat'])) {
    if (!isEmailKnown($data['email'])) {
      $data['valid'] = true;
    }
    else {
      $data['emailError'] = "Email address already registered";
    }
  }
  return $data;
}
?>
