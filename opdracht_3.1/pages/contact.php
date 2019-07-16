<?php
include_once 'formfield.php';

function showContactContent($data) {
  showForm($data);
}

function processContactPage($data) {
  try {
    $data = validateContactForm($data);
    if ($data['valid']) {
      $data['page'] = "contact_thanks"; }
  }
  catch(Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
  return $data;
}

function validateContactForm($data) {
  $data['name'] = testInput(getPostValue('name'));
  $data['email'] = testInput(getPostValue('email'));
  $data['message'] = testInput(getPostValue('message'));
  $data['valid'] = false;

  empty($data['name']) ? $data['nameError'] = "Name required" : $data['nameError'] = "";
  empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
  empty($data['message']) ? $data['messageError'] = "Please type your message" : $data['messageError'] = "";

  if (empty($data['nameError']) && empty($data['emailError']) && empty($data['messageError'])) {
    $data['valid'] = true;
  }
  return $data;
}
?>
