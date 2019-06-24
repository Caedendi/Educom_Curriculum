<?php /* JH: Zet deze ook in html.php */
function showHeader($page) {
  $header = testInput($page);
  echo '
    <h1 class="header">'. ucfirst($header) . '</h1>
  ';
}
?>
