<?php
function showSqlContent($data) {
  echo '
    <p>DEBUG TEST PAGE</p>
  ';


  echo "<br><br><br>";
  $link = connectToDatabase();
  foreach ($link as $key => $value) {
    echo "$key => $value" . "<br>";
  }
  print_r($link);

  echo "<br><br><br>";

  $userData = findUserByEmailSql("hoi1@hoi.nl");

  echo '<br>print found data<br>';
  foreach ($userData as $key => $value) {
    echo "$key => $value" . "<br>";
  }
}
?>
