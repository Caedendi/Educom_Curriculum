<?php

  //==============================================
  // MAIN APP
  //==============================================
  session_start();
  $page = getRequestedPage();
  validateRequest();
  showResponsePage($page);
  //==============================================
  // FUNCTIONS
  //==============================================
  function getRequestedPage() {
    $requestType = $_SERVER["REQUEST_METHOD"];
    if ($requestType == "POST") {
      $requestedPage = getPostVar('page', 'home');
    }
    else {
      $requestedPage = getUrlVar('page', 'home');
    }
    return $requestedPage;
  }

  function validateRequest() {

  }

  function showResponsePage($page) {
    include 'html_start.php'; showStartHtml();
    include 'head_section.php'; showHeadSection();
    showBodySection($page);
    include 'html_end.php'; showHtmlEnd();
  }

  function getPostVar($key, $default='') {
    $value = filter_input(INPUT_POST, $key);
    return isset($value) ? $value : $default;
  }

  function getUrlVar($key, $default='') {
    $value = filter_input(INPUT_GET, $key);
    return isset($value) ? $value : $default;
  }

  function showBodySection($page) {
    include 'body_start.php'; showBodyStart();
    include 'header.php'; showHeader($page);
    include 'navbar.php'; showMenu($page);
    showMainContent($page);
    include 'footer.php'; showFooter();
    include 'body_end.php'; showBodyEnd();
  }

  function showMainContent($page) {
    switch ($page) {
      case 'home':
        include 'home.php';
        showHomeContent();
        break;
      case 'about':
        include 'about.php';
        showAboutContent();
        break;
      case 'contact':
        include 'contact.php';
        showContactContent();
        break;
      case 'login':
        include 'login.php';
        showLoginContent();
        break;
      case 'register':
        include 'register.php';
        showRegisterContent();
        break;
      default:
        echo "Page [".$page."] not found.";
        break;
    }
  }
?>
