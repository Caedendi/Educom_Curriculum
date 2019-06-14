<?php
function showHeader($page) {
  echo '
    <h1 class="header">'. ucfirst($page) . '</h1>
  ';

  /* JH: Omdat $page nooit door test_input is gehaald, is deze code vatbaar voor XSS (cross side scripting) */
  
}
?>
