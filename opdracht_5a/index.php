<?php
//==============================================
// INCLUDES
//==============================================
require_once "definitions.php";
include_once 'exceptions/custom_exceptions.php';
include_once PROJECT_ROOT . "page_controller.php";
//==============================================
// MAIN APP
//==============================================

/* JH: Als je commentaar boven een functie wilt zetten, gebruik dan doc-type style commentaar met /** alsvolgt:
/**
 * Validates the login form
 *
 * Checks that both input fields are filled and the passwords match with the database
 * @param array $data the array with data fields
 * @return array the modified data array
 */

session_start();
$controller = new PageController();
$controller->handleRequest();
?>
