<?php
function showRegisterContent($data) {
  showRegisterForm($data);
}

function showRegisterForm($data) {
  showFormStart($data['page']);
  showFormInput('text', 'name', 'Naam:', 'uw volledige naam', $data);
  showFormInput('email', 'email', 'Email:', 'uw emailadres', $data);
  showFormInput('password', 'password', 'Wachtwoord:', 'uw wachtwoord', $data);
  showFormInput('password', 'passwordRepeat', 'Herhaal wachtwoord:', 'herhaal wachtwoord', $data);
  showFormSubmit("Verstuur");
  showFormEnd();
}

function validateRegisterForm($data) {
  $data['name'] = testInput(getPostValue('name'));
  $data['email'] = testInput(getPostValue('email'));
  $data['password'] = testInput(getPostValue('password'));
  $data['passwordRepeat'] = testInput(getPostValue('passwordRepeat'));
  $data['valid'] = false;
  // if any field is empty, show error
  if (empty($data['name']) || empty($data['email']) || empty($data['password']) || empty($data['passwordRepeat'])) {
    empty($data['name']) ? $data['nameError'] = "Name required" : $data['nameError'] = "";
    empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
    empty($data['password']) ? $data['passwordError'] = "Password required" : $data['passwordError'] = "";
    empty($data['passwordRepeat']) ? $data['passwordRepeatError'] = "Please repeat password" : $data['passwordRepeatError'] = "";
  }
  // if passwords dont match, show error
  if ($data['password'] != $data['passwordRepeat']) {
    $data['passwordError'] = "Passwords do not match";
  }

  // if all fields filled & passwords match, then check if email already registered
  // yes? show register error
  // no? set register is valid
  else if ((!empty($data['name']) && !empty($data['email']) && !empty($data['password']) && !empty($data['passwordRepeat']))
        && ($data['password'] == $data['passwordRepeat'])) {
    (isEmailKnown($data['email'])) ? $data['emailError'] = "Email address already registered" : $data['valid'] = true;
  }
  return $data;
}
?>
