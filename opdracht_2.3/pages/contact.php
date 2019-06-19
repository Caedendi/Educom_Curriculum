<?php
function showContactContent($data) {
  showContactForm($data);
}

function showContactForm($data) {
  showFormStart($data['page']);
  showFormInput('text', 'name', 'Naam:', 'uw volledige naam', $data);
  showFormInput('email', 'email', 'Email:', 'uw emailadres', $data);
  showFormInput('textarea', 'message', 'Bericht:', 'typ hier uw bericht', $data, 10, 50);
  showFormSubmit("Verstuur");
  showFormEnd();
}
?>
