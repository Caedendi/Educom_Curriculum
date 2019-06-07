<?php
  $page = "";
  echo 'hello world';

  function showStartHtml() {
    include 'start_html.php';
  }

  function showBodyStart() {
    include 'body_start.php';
  }

  function showMenu() {
    include 'navbar.php';
  }

  function showHeader() {
    include 'header.php';
  }

  function showFooter() {
    include 'footer.php';
  }

  function showBodyEnd() {
    include 'body_end.php';
  }

  // function showMainContent() {
  //   include 'asdf';
  // }

  function showBodySection() {
    showBodyStart();
    showMenu();
    // showMainContent();
    showBodyEnd();
  }

  function showResponsePage() {
    showStartHtml();
    showHeader();
    showBodySection();
    showFooter();
  }

  showResponsePage();








?>
