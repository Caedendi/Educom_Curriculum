<?php
include_once 'html.php';

function buildPage($data) {
  showHtmlStart();
  showHeadSection();
  showBodySection($data);
  showHtmlEnd();
}

function showBodySection($data) {
  showBodyStart();
  showHeader($data['page']);
  showMenu($data);
  showMainContent($data);
  showFooter();
  showBodyEnd();
}

function showMainContent($data) {
  showMainContentStart();
  try {
    showPageContent($data);
  }
  catch (PageNotFoundException $e) {
    echo $e->getMessage();
    $data['page'] = "error_page_not_found";
  }
  showMainContentEnd();
}

function showPageContent($data) {
  include_once './pages/' . $data['page'] . '.php';
  call_user_func("show" . $data['page'] . "Content", $data); // calls function show*page*Content() function of respective page
}
?>
