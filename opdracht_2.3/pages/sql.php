<?php
function showSqlContent($data) {
  echo '
    <p>SQL Page</p>
  ';
  $link = mysqli_connect("localhost", "educom1", "monitor", "educom");

  if (!$link) {
    echo "<br>";
    echo "Error: Unable to connect to MySQL." . "<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
  }
  else echo "succes!" . "<br>";
  echo "Host information: " . mysqli_get_host_info($link) . "<br>";

  mysqli_close($link);

}
?>
