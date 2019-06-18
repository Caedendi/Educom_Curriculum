<?php /* JH: Dit soort functies kan je beter verzamelen in een file (bijv. html.php) */
function showHeader($page) {
  echo '
    <h1 class="header">'. ucfirst($page /* JH: Omdat $page nooit door test_input is gehaald, is deze code vatbaar voor XSS (cross side scripting) */) . '</h1>
  ';
}
?>
