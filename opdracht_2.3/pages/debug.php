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

  $userData = findUserByEmailSql("hoi@hoi.nl");

  echo '<br>Found data:<br>';
  if ($userData) {
    foreach ($userData as $key => $value) {
      echo "$key => $value" . "<br>";
    }
  } else {
    echo "[hoi2] userData is empty: ". gettype($userData);
  }
}
?>
