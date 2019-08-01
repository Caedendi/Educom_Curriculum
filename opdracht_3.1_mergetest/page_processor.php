<?php
function verifyPage($data) {
  if (!file_exists('./pages/' . $data['page'] . '.php')) {
    $data['page'] = "error_page_not_found";
  }
  return $data;
}

function processPostRequest($data) {
  switch ($data['page']) {
    case "login":
      include_once './pages/login.php';
      $data = processLoginPage($data);
    break;
    case "register":
      include_once './pages/register.php';
      $data = processRegisterPage($data);
    break;
    case "contact":
      include_once './pages/contact.php';
      $data = processContactPage($data);
    break;
    case "webshop":
      include_once './pages/webshop.php';
      processWebshopPage();
      break;
    case "details":
      include_once './pages/details.php';
      $data = processDetailsPage($data);
      break;
    case "cart":
      include_once './pages/cart.php';
      $data = processCartPage($data);
      break;
  }
  return $data;
}

function processGetRequest($data) {
  switch ($data['page']) {
    case "logout":
      logoutUser();
      $data['page'] = "home";
      break;
    case "details":
      $data['id'] = testInput(getUrlValue('id'));
      break;
  }
  return $data;
}

function preparePage($data) {
  $data = buildNavbarMeta($data);
  switch($data['page']) {
    case "webshop":
      include_once './pages/webshop.php';
      $data = prepareWebshopPage($data);
      break;
    case "details":
      include_once './pages/details.php';
      $data = prepareDetailsPage($data);
      break;
    case "cart":
      include_once './pages/cart.php';
      $data = prepareCartPage($data);
      break;
    case "login":
      $data = buildLoginPageMeta($data);
      break;
    case "register":
      $data = buildRegisterPageMeta($data);
      break;
    case "contact":
      $data = buildContactPageMeta($data);
      break;
  }
  return $data;
}
?>
