<?php
//==============================================
// INCLUDES
//==============================================
include 'html.php';
include 'header.php';
include 'navbar.php';
include 'footer.php';
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
    $requestedPage = testInput(agetPostVar('page', 'home')); }
  else if ($requestType == "GET") {
    $requestedPage = testInput(agetUrlVar('page', 'home')); }
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
  showStartHtml();
  showHeadSection();
  showBodySection($data);
  showHtmlEnd();
}

function showBodySection($data) {
  showBodyStart();
  showHeader($data['page']);
  showMenu($data['page']);
  showMainContent($data);
  showFooter();
  showBodyEnd();
}

function showMainContent($data) {
  showMainBodyStart();
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
  showMainBodyEnd();
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
function testInput($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
?>
