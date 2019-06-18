<?php
function showSqlContent($data) {
  echo '
    <p>SQL Page</p>
  ';

  $server = "localhost";
  $username = "educom1";
  $password = "monitor";
  $database = "educom";

  $link = mysqli_connect($server, $username, $password, $database);

  if (!$link) {
    echo "<br>";
    echo "Error: Unable to connect to MySQL." . "<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
  }
  else echo "Verbonden" . "<br>";
  echo "Host information: " . mysqli_get_host_info($link) . "<br>";

  $sql = '
    SELECT *
    FROM users
    WHERE email="asdf@asdf.asdf"
  ';
  $result = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. "<br> email: " . $row["email"]. "<br> password: " . $row["password"]. "<br> name: " . $row["name"];
    }
  }
  else {
    echo "0 results";
  }


  mysqli_close($link);


}
?>
