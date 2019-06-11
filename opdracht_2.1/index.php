<?php
  $page = '';

  function getRequestedPage() {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      isset($_GET['page']) ? $page = $_GET['page'] : $page = 'home';
      return $page;
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
      isset($_POST['page']) ? $page = $_POST['page'] : $page = 'home';
      return $page;
    }
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
    default:
      //show error
      echo 'ERROR IN showMainContent()';

      include 'home.php';
      showHomeContent();
      break;
    }
  }

  function showBodySection($page) {
    include 'body_start.php'; showBodyStart();
    include 'navbar.php'; showMenu();
    showMainContent($page);
  }

  function showResponsePage($page) {
    include 'html_start.php'; showStartHtml();

    // header voor elke pagina inbouwen
    include 'head_section.php'; showHeadSection();
    showBodySection($page);
    include 'footer.php'; showFooter();
    include 'body_end.php'; showBodyEnd();
    include 'html_end.php'; showHtmlEnd();
  }

  $page = getRequestedPage();
  showResponsePage($page);


?>
