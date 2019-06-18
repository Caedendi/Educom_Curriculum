<?php

  //==============================================
  // MAIN APP
  //==============================================
  $page = getRequestedPage();
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

  function showResponsePage($page) {
    /* JH: Omdat deze includes altijd worden geladen, kan je beter de includes bovenin de file zetten */
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
    /* JH: Omdat deze includes altijd worden geladen, kan je beter de includes bovenin de file zetten */
    include 'body_start.php'; showBodyStart();
    include 'header.php'; showHeader($page);
    include 'navbar.php'; showMenu($page);
    showMainContent($page);
    include 'footer.php'; showFooter();
    include 'body_end.php'; showBodyEnd();
  }

  function showMainContent($page) {
    /* JH: Moet de <div class="mainbody"> is ook voor iedere pagina hetzelfde en kan hier ook bij */
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
      default:
        echo "Page [".$page."] not found.";
        break;
    }
  }
?>
