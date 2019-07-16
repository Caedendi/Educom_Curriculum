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
    <title>Opdracht 2.3.php</title>
    <link rel="stylesheet" type="text/css" href="./css/FirstExternalSheet.css">
  </head>
  ';
}

function showBodyStart() {
  echo '
    <body>
  ';
}

function showHeader($page) {
  echo '
    <h1 class="header">'. ucfirst($page) . '</h1>
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
  /* JH: Wat doet die comment in deze string, deze wordt niet naar de brouwser gestuurd hoor */
}

function showBodyEnd() {
  echo '
    </body>
  ';
}

function showFooter() {
  echo '
  <footer>
    <section>
      <p>&copy; 2019 Bart Commandeur</p>
    </section>
  </footer>
  ';
}

function showHtmlEnd() {
  echo '
    </html>
  ';
}
?>
