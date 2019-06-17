<?php
//==============================================
// INCLUDES
//==============================================
include 'html.php';
include 'header.php';
include 'navbar.php';
include 'footer.php';
include './users/userdata_management.php';
include './users/userdata_source.php';
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
    $requestedPage = testInput(getPostVar('page', 'home')); }
  else if ($requestType == "GET") {
    $requestedPage = testInput(getUrlVar('page', 'home')); }
  return $requestedPage;
}

function validateRequest($page) {
  $data = array('page' => $page);
  $requestType = $_SERVER["REQUEST_METHOD"];
  if ($requestType == "POST") {
    //==============================
    // Validate login page
    //==============================
    if ($data['page'] == "login") {
      $data['email'] = testInput(getPostVar('email'));
      $data['password'] = testInput(getPostVar('password'));
      empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
      empty($data['password']) ? $data['passwordError'] = "Password required" : $data['passwordError'] = "";
      $data = validateLogin($data);
      if($data['valid']) { // set session variables name and email, redirect to homepage
        $_SESSION['user_name'] = $data['name'];
        $_SESSION['user'] = $data['email'];
        $data['page'] = "home";
      }
      else {
        $data['newLogin'] = false;
      }
    } // end POST login
    //==============================
    // Validate register page
    //==============================
    else if ($page == "register") {
      $data['name'] = testInput(getPostVar('name'));
      $data['email'] = testInput(getPostVar('email'));
      $data['password'] = testInput(getPostVar('password'));
      $data['passwordRepeat'] = testInput(getPostVar('passwordRepeat'));
      empty($data['name']) ? $data['nameError'] = "Name required" : $data['nameError'] = "";
      empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
      empty($data['password']) ? $data['passwordError'] = "Password required" : $data['passwordError'] = "";
      empty($data['passwordRepeat']) ? $data['passwordRepeatError'] = "Please repeat password" : $data['passwordRepeatError'] = "";
      $data = validateRegister($data);
      if($data['valid']) { // store new user, show thanks + submitted info
        storeUser($data['name'], $data['email'], $data['password']);
        $data['newLogin'] = true;
        $data['page'] = "login";
      }
      else {
        $data['newRegister'] = false;
      }
    } // end POST register
    //==============================
    // Validate contact page
    //==============================
    else if ($page == "contact") {
      $data['name'] = testInput(getPostVar('name'));
      $data['email'] = testInput(getPostVar('email'));
      $data['message'] = testInput(getPostVar('message'));
      empty($data['name']) ? $data['nameError'] = "Name required" : $data['nameError'] = "";
      empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
      empty($data['message']) ? $data['messageError'] = "Please type your message" : $data['messageError'] = "";
      $data = validateContactForm($data);
      if ($data['valid']) { // show thanks message + submitted info
        $data['page'] = "thanks";
      }
      else {
        $data['newContactForm'] = false;
      }
    }
  } // end if POST
  //==============================
  // Do GET stuff
  //==============================
  else if ($requestType == "GET") {
    if ($data['page'] == "login") {
      $data['email'] = "";
      $data['password'] = "";
      $data['newLogin'] = true;
      $data['emailError'] = "";
      $data['passwordError'] = "";
      $data['emailError'] = "";
      $data['passwordError'] = "";
    }
    else if ($data['page'] == "register") {
      $data['name'] = "";
      $data['email'] = "";
      $data['password'] = "";
      $data['passwordRepeat'] = "";
      $data['newRegister'] = true;
      $data['nameError'] = "";
      $data['emailError'] = "";
      $data['passwordError'] = "";
      $data['passwordRepeatError'] = "";
    }
    else if ($data['page'] == "contact") {
      $data['name'] = "";
      $data['email'] = "";
      $data['message'] = "";
      $data['newContactForm'] = true;
      $data['nameError'] = "";
      $data['emailError'] = "";
      $data['messageError'] = "";
    }
    else if ($data['page'] == "logout") {
      session_destroy();
      $data['page'] = "home";
    }
  } // end if GET
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
    case 'thanks':
      include './pages/contact_thanks.php';
      showThanksContent($data);
      break;
    case 'login':
      include './pages/login.php';
      showLoginContent($data);
      break;
    case 'register':
      include './pages/register.php';
      showRegisterContent($data);
      break;
    // case 'logout':
    //   include './pages/logout.php';
    //   showLogoutContent($data);
    //   break;
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
