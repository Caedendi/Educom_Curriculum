<?php
//==============================================
// INCLUDES
//==============================================
include 'debug_config.php';
include 'functions.php';
include 'html.php';
include 'navbar.php';
include 'formfield.php';
include './users/userdata_management.php';
include './users/userdata_source.php';
include './users/session_manager.php';
include './pages/login.php';
include './pages/register.php';
include './pages/contact.php';
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
    $requestedPage = testInput(getPostValue('page', 'home')); }
  else if ($requestType == "GET") {
    $requestedPage = testInput(getUrlValue('page', 'home')); }
  return $requestedPage;
}

function validateRequest($page) {
  $data = array('page' => $page);
  $requestType = $_SERVER["REQUEST_METHOD"];
  if ($requestType == "POST") {
    switch ($data['page']) {
      case "login":
        try {
          $data = validateLoginForm($data);
          if($data['valid']) { // login user, show home page
            loginUser($data['name'], $data['email']);
            $data['page'] = "home";
          }
        }
        catch(Exception $e) {
          echo 'Message: ' . $e->getMessage();
        }
      break;
      case "register":
        try {
          $data = validateRegisterForm($data);
          if($data['valid']) { // store new user, show login page
            storeUser($data['name'], $data['email'], $data['password']);
            $data['page'] = "login";
          }
        }
        catch(Exception $e) {
          echo 'Message: ' . $e->getMessage();
        }
      break;
      case "contact":
        try {
          $data = validateContactForm($data);
          if ($data['valid']) {
            $data['page'] = "contact_thanks";
          }
        }
        catch(Exception $e) {
          echo 'Message: ' . $e->getMessage();
        }
      break;
    } // end switch POST
  } // end POST
  else if ($requestType == "GET") {
    switch ($data['page']) {
      case "logout":
        logoutUser();
        $data['page'] = "home";
        break;
    } // end switch GET
  } // end GET
  return $data; // end validateRequest()
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
      showContactContent($data);
      break;
    case 'contact_thanks':
      include './pages/contact_thanks.php';
      showThanksContent($data);
      break;
    case 'debug':
      if (DEBUG_TEST_PAGE) {
        include './pages/debug.php';
        showSqlContent($data);
      }
      else {
        echo "Page [".$data['page']."] not found.";
      }
      break;
    case 'login':
      showLoginContent($data);
      break;
    case 'register':
      showRegisterContent($data);
      break;
    default:
      echo "Page [".$data['page']."] not found.";
      break;
  }
  showMainBodyEnd();
}
?>
