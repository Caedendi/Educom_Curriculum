<?php
  /* JH: ALs je dit soort debug wil doen, is het beter om een losse PHP pagina te maken (iets als userdata_source_test.php) die geen gebruik maakt van de index.php als ingang */
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
