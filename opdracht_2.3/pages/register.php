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
?>
