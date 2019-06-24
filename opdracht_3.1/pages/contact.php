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

function validateContactForm($data) {
  $data['name'] = testInput(getPostValue('name'));
  $data['email'] = testInput(getPostValue('email'));
  $data['message'] = testInput(getPostValue('message'));
  $data['valid'] = false;
  if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
    empty($data['name']) ? $data['nameError'] = "Name required" : $data['nameError'] = "";
    empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
    empty($data['message']) ? $data['messageError'] = "Please type your message" : $data['messageError'] = "";
  }
  else if (!empty($data['name']) && !empty($data['email']) && !empty($data['message']))
    $data['valid'] = true;
  return $data;
}
?>
