<?php
function connectToDatabase() {
  $server = "localhost";
  $username = "educom1";
  $password = "monitor1";
  $database = "educom";
  $link = mysqli_connect($server, $username, $password, $database);
  if (!$link) {
    throw new Exception("Unable to connect to database");
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    return $link;
  }
  else echo "Verbonden" . "<br>";
  echo "Host information: " . mysqli_get_host_info($link) . "<br>";
  return $link;
}

function findUserByEmailSql($email) {
  $userData = NULL;
  try {
    $link = connectToDatabase();
    $sql = '
      SELECT *
      FROM users
      WHERE email="'. $email . '"
    ';
    $result = mysqli_query($link, $sql);
    $userData = mysqli_fetch_assoc($result);
    mysqli_close($link);
    return $userData;
  }
  catch(Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
}

function saveUserToDatabase($name, $email, $password) {
  $link = connectToDatabase();
  $sql = '
    INSERT INTO users (email, password, name)
    VALUES ("'.$email.'", "'.$password.'", "'.$name.'")
  ';
  if (mysqli_query($link, $sql)) {
    // echo "GEREGISTREERD IN DATABASE YO<br>";
  }
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
  }
  mysqli_close($link);
}

//==============================
// Not yet implemented
//==============================
function deleteUserFromDatabase($id) {
 /* JH: Beter geen lege functie in een file laten staan, mensen denken dan dat ze deze kunnen gebruiken */
}
?>
