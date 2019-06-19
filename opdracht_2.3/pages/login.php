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
?>
