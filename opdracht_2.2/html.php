<?php
function showStartHtml() {
  echo '
  <!DOCTYPE html>
    <html>
  ';
}

function showHeadSection() {
  echo '
  <head>
    <title>Opdracht 2.2.php</title>
    <link rel="stylesheet" type="text/css" href="./css/FirstExternalSheet.css">
  </head>
  ';
}

function showBodyStart() {
  echo '
    <body>
  ';
}

function showMainBodyStart() {
  echo '
    <div class="mainBody">
  ';
}

function showMainBodyEnd() {
  echo '
    </div> ' /* mainBody */ . '
  ';
}

function showBodyEnd() {
  echo '
    </body>
  ';
}

function showHtmlEnd() {
  echo '
    </html>
  ';
}
?>
