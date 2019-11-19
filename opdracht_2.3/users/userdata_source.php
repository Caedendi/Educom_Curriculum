<?php
function connectToDatabase() {
  $server = "localhost";
  $username = "educom1";
  $password = "monitor";
  $database = "bartcommandeur_webshop";
  $link = mysqli_connect($server, $username, $password, $database);
  if (!$link) {
    throw new DatabaseConnectionException("Unable to connect to database");
    // echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    // echo "Debugging error: " . mysqli_connect_error() . "<br>";
  }
  // else echo "Verbonden" . "<br>";
  // echo "Host information: " . mysqli_get_host_info($link) . "<br>";
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
    return $userData;
  }
  finally {
    mysqli_close($link);
  }
}

function saveUserToDatabase($name, $email, $password) {
  try {
    $link = connectToDatabase();
    $sql = '
      INSERT INTO users (email, password, name)
      VALUES ("'.$email.'", "'.$password.'", "'.$name.'")
    ';
    if (mysqli_query($link, $sql)) {
      // echo "Geregistreerd in database<br>";
    }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
  }
  finally {
    mysqli_close($link);
  }
}

//==============================
// Not yet implemented
//==============================
function deleteUserFromDatabase($id) {
 /* JH: Beter geen lege functie in een file laten staan, mensen denken dan dat ze deze kunnen gebruiken */
}
?>
