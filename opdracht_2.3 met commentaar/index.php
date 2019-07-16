<?php
//==============================================
// INCLUDES
//==============================================
include 'custom_exceptions.php';
include 'debug_config.php';
include 'functions.php';
include 'html.php';
include 'navbar.php';
include 'formfield.php';
/* JH: Include de betreffende files pas als je ze nodig hebt (en gebruik include_once om te voorkomen dat ze 2x geladen worden) */
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
        catch(DatabaseConnectionException $e) {
          $data['page'] = "technical_error";
          // echo 'Message: ' . $e->getMessage();
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
        catch(DatabaseConnectionException $e) {
          $data['page'] = "technical_error";
          // echo 'Message: ' . $e->getMessage();
        }
      break;
      case "contact":
        $data = validateContactForm($data);
        if ($data['valid']) {
          $data['page'] = "contact_thanks";
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

  /* JH Extra: Zie opmerking in navbar.php op regel 4 bouw hier het menu op in metaData

                $data['menu'] = array(
                  array('link' => 'home', 'label' => 'HOME', 'navButtonClass' => 'regularButton'),
                  array('link' => 'about', ... )
                )
                if (isLoggedIn()) {
                  array_push($data['menu'],  array('link' => 'logout', 'label' => 'LOGOUT '  . getLoggedInUserFirstName(), 'navButtonClass' => 'logout');
                } else {
                  ...
                }
  */    
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
      showContactContent($data); /* JH TIP: Je kan ook gelijk showContactForm($data) hier aanroepen en dan de showContactContent opruimen */
      break;
    case 'contact_thanks':
      include './pages/contact_thanks.php';
      showThanksContent($data);
      break;
    case 'debug':
      if (DEBUG_TEST_PAGE) {
        include './pages/debug.php';
        showSqlContent($data);
      /* JH TIP: onderstaande code lijkt erg op de default case, je kan deze combineren door te zetten
        break;
      }
      // fall through
    default:
      echo "Page [".$data['page']."] not found.";
    */}
      break;
    case 'login':
      showLoginContent($data); /* JH TIP: Je kan ook gelijk showLoginForm($data) hier aanroepen en dan de showLoginContent opruimen */
      break;
    case 'register':
      showRegisterContent($data); /* JH TIP: Je kan ook gelijk showRegisterForm($data) hier aanroepen en dan de showRegisterContent opruimen */
      break;
    case 'technical_error':
      include './pages/technical_error.php';
      showTechnicalErrorContent();
      break;
    default:
      echo "Page [".$data['page']."] not found.";
      break;
  }
  showMainBodyEnd();
}
?>
