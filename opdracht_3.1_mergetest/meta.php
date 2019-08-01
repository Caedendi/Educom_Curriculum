<?php
include_once './data_management/session_manager.php';

function buildNavbarMeta($data) {
  $data['menu'] = array(
    array('link' => "home", 'label' => "HOME", 'class' => "regular"),
    array('link' => "webshop", 'label' => "WEBSHOP", 'class' => "regular")
  );
  if (isUserLoggedIn()) {
    array_push($data['menu'], array('link' => "cart", 'label' => "SHOPPING CART (" . getItemTotalInCart() . ")", 'class' => "regular")); // TODO add amount of items in cart to label
  }
    array_push($data['menu'], array('link' => "about", 'label' => "ABOUT", 'class' => "regular"));
    array_push($data['menu'], array('link' => "contact", 'label' => "CONTACT", 'class' => "regular"));
  if (isUserLoggedIn()) {
    array_push($data['menu'], array('link' => "logout", 'label' => "LOGOUT [" . getLoggedInUserFirstName() . "]", 'class' => "rightAligned"));
  }
  else {
    array_push($data['menu'], array('link' => "login", 'label' => "LOGIN", 'class' => "rightAligned"));
    array_push($data['menu'], array('link' => "register", 'label' => "REGISTER", 'class' => "rightAligned"));
  }
  return $data;
}

function buildLoginPageMeta($data) {
  $data['form'] = array(
    array('type' => "email", 'key' => "email", 'label' => "Email:", 'placeholder' => "uw emailadres"),
    array('type' => "password", 'key' => "password", 'label' => "Wachtwoord:", 'placeholder' => "uw wachtwoord")
  );
  $data['submit'] = "Login";
  return $data;
}

function buildRegisterPageMeta($data) {
  $data['form'] = array(
    array('type' => "text", 'key' => "name", 'label' => "Naam:", 'placeholder' => "uw volledige naam"),
    array('type' => "email", 'key' => "email", 'label' => "Email:", 'placeholder' => "uw emailadres"),
    array('type' => "password", 'key' => "password", 'label' => "Wachtwoord:", 'placeholder' => "uw wachtwoord"),
    array('type' => "password", 'key' => "passwordRepeat", 'label' => "Herhaal achtwoord:", 'placeholder' => "herhaal wachtwoord")
  );
  $data['submit'] = "Registreer";
  return $data;
}

function buildContactPageMeta($data) {
  $data['form'] = array(
    array('type' => "text", 'key' => "name", 'label' => "Naam:", 'placeholder' => "uw volledige naam"),
    array('type' => "email", 'key' => "email", 'label' => "Email:", 'placeholder' => "uw emailadres"),
    array('type' => "textarea", 'key' => "message", 'label' => "Bericht:", 'placeholder' => "typ hier uw bericht")
  );
  $data['submit'] = "Verstuur";
  return $data;
}
?>
