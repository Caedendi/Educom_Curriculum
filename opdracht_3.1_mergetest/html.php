<?php
function showHtmlStart() {
  echo '
  <!DOCTYPE html>
    <html>
  ';
}

function showHeadSection() {
  echo '
  <head>
    <title>Opdracht 3.1.php</title>
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
    <header>
      <h1>'. ucfirst($page) . '</h1>
    </header>
  ';
}

function showMainContentStart() {
  echo '
    <div class="mainBody">
  ';
}

function showMainContentEnd() {
  echo '
    </div> ' /* mainBody */ . '
  ';
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

function showUnderConstruction() {
    echo '
      <h2 style="color:black;font-weight:bold;text-align:center;">Under construction</h2>
      <p>' . LOREM_IPSUM . '</p>
    ';
}
?>
