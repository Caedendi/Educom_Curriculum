<?php
  $page = 'home';
  echo 'hello world';


  function getRequestedPage() {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      isset 'page' in $_GET ? $page = $_GET['page'] : $page = 'home';
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
      isset 'page' in $_POST ? $page = $_POST['page'] : $page = 'home';
    }

  }



  // show home/contact/about inbouwen
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
    include 'headSection.php'; showHeadSection();
    showBodySection($page);
    include 'footer.php'; showFooter();
    include 'body_end.php'; showBodyEnd();
    include 'html_end.php'; showHtmlEnd();
  }

  $page = getRequestedPage();
  showResponsePage($page);


?>
