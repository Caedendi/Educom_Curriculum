<?php
//==============================================
// INCLUDES
//==============================================
include_once 'custom_exceptions.php';
include_once 'debug_config.php';
include_once 'constants.php';
include_once 'functions.php';
include_once 'page_processor.php';
include_once 'page_builder.php';
include_once 'navbar.php';
include_once 'meta.php';
/* JH: Include de betreffende files pas als je ze nodig hebt (en gebruik include_once om te voorkomen dat ze 2x geladen worden) */
include_once './data_management/data_source.php';
include_once './data_management/userdata_management.php';
include_once './data_management/webshop_management.php';
include_once './data_management/session_manager.php';
include_once './pages/login.php';
include_once './pages/register.php';
include_once './pages/contact.php';
//==============================================
// MAIN APP
//==============================================
session_start();
$page = getRequestedPage();
$data = handleRequest($page);
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

/*
 * executes functions in page_processor.php
 */
function handleRequest($page) {
  $data = array('page' => $page);
  $data = verifyPage($data);
  $requestType = $_SERVER["REQUEST_METHOD"];
  if ($requestType == "POST") {
    $data = processPostRequest($data);
  }
  else if ($requestType == "GET") {
    $data = processGetRequest($data);
  }
  $data = preparePage($data);
  return $data;
}

/*
 * executes functions in page_builder.php
 */
function showResponsePage($data) {
  buildPage($data);
}
?>
