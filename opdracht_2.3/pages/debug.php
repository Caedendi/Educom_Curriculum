<?php
function showSqlContent($data) {
  echo '
    <p>DEBUG TEST PAGE</p>
  ';



  $userData = findUserByEmailSql("hoi@hoi.nl");

  echo '<br>Found data:<br>';
  if ($userData) {
    foreach ($userData as $key => $value) {
      echo "$key => $value" . "<br>";
    }
  } else {
    echo "userData is empty. Type = ". gettype($userData);
  }

  echo '<br>';
  $testresult = authenticateUserLogin("hoi@hoi.nl", "hoi");
  if ($testresult) {
    foreach ($testresult as $key => $value) {
      echo "$key => $value" . "<br>";
    }
  } else {
    echo "userData is empty. Type = ". gettype($testresult);
  }
}
?>
