<?php
//==============================================
// MAIN APP
//==============================================
session_start();
$page = getRequestedPage();
$data = validateRequest($page);
showResponsePage($data);
//==============================================
// FUNCTIONS
//==============================================
function getRequestedPage() {
  $requestType = $_SERVER["REQUEST_METHOD"];
  if ($requestType == "POST") {
    $requestedPage = getPostVar('page', 'home'); }
  else {
    $requestedPage = getUrlVar('page', 'home'); }
  return $requestedPage;
}

function validateRequest($page) {
  // to do

  /*
  if ($requestType == "POST") {
    if ($page == "contact") {
    validateContact();
    }
    else if ($page == "login") {
      validateLogin();
    }
    else if ($page == "register")
      validateRegister();
  }
  */



  $data = array('page' => $page);
  return $data;
}

function showResponsePage($data) {
  include 'html.php';
  showStartHtml();
  showHeadSection();
  showBodySection($data);
  showHtmlEnd();
}

function showBodySection($data) {
  showBodyStart();
  include 'header.php'; showHeader($data['page']);
  include 'navbar.php'; showMenu($data['page']);
  showMainContent($data);
  include 'footer.php'; showFooter();
  showBodyEnd();
}

function showMainContent($data) {
  switch ($data['page']) {
    case 'home':
      include './pages/home.php';
      showHomeContent();
      break;
    case 'about':
      include './pages/about.php';
      showAboutContent();
      break;
    case 'contact':
      include './pages/contact.php';
      showContactContent($data);
      break;
    case 'login':
      include './pages/login.php';
      showLoginContent($data);
      break;
    case 'register':
      include './pages/register.php';
      showRegisterContent($data);
      break;
    case 'logout':
      include './pages/logout.php';
      showLogoutContent($data);
      break;
    default:
      echo "Page [".$page."] not found.";
      break;
  }
}

function getPostVar($key, $default='') {
  $value = filter_input(INPUT_POST, $key);
  return isset($value) ? $value : $default;
}

function getUrlVar($key, $default='') {
  $value = filter_input(INPUT_GET, $key);
  return isset($value) ? $value : $default;
}

// tests form input data for security purposes
function test_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
?>
