<?php
//==============================
// SQL functions
//==============================
function connectToDatabase() {
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
    return $link;
  }
  else echo "Verbonden" . "<br>";
  echo "Host information: " . mysqli_get_host_info($link) . "<br>";

  return $link;
}

// implemented
//
// rewritten findUserByEmail() method that searches the database
function findUserByEmailSql($email) {
  $link = connectToDatabase();
  if (empty($link)) {
    echo '[hoi1] connection failed';
    return $userData;
  }

  $sql = '
    SELECT *
    FROM users
    WHERE email="'. $email . '"
  ';

  $result = mysqli_query($link, $sql);
  $userData = mysqli_fetch_assoc($result);
  mysqli_close($link);
  // echo gettype($userData);
  return $userData;
}

// not yet implemented
//
// rewritten saveUser() method to store new user to database
function saveUserSql($name, $email, $password) {
  //
  // TO DO
  //


  $userDataFile = fopen(__DIR__ . "/users.txt", "a") or die("saveUser() can not open users.txt");
  $newUser = PHP_EOL . $email . "|" . $name . "|" . $password;
  fwrite($userDataFile, $newUser);
  fclose($userDataFile);
}

//==============================
// Datafile functions
//==============================
// scans /users.txt for existing email (input).
// found? return data (array w/ name, email, password).
// not found? return empty variable.
function findUserByEmailInDatafile($email) {
  $userData = "";
  $userDataFile = fopen(__DIR__ . "/users.txt", "r") or die("findUserByEmailInDatafile() can not open users.txt");
  fgets($userDataFile); // skip first line
  while (!feof($userDataFile)) {
    $currentUser = explode("|", testInput(fgets($userDataFile)));
    // print_r($currentUser); echo '<br>';
    if ($currentUser[0] == $email) {
      // echo $email . "<br>"; // used for debugging
      $userData = array('name' => testInput($currentUser[1]), 'email' => testInput($currentUser[0]), 'password' => testInput($currentUser[2]));
      // echo "<br>" . $userData['name'] . "<br>" . $userData['email'] . "<br>" . $userData['password'] . "<br>"; // used for debugging
      break;
    }
  }
  fclose($userDataFile);
  return $userData;
}

// to do
//
// saves input user data to file.
// does not check if email already exists.
function saveUserInDatafile($name, $email, $password) {
  $userDataFile = fopen(__DIR__ . "/users.txt", "a") or die("saveUser() can not open users.txt");
  $newUser = PHP_EOL . $email . "|" . $name . "|" . $password;
  fwrite($userDataFile, $newUser);
  fclose($userDataFile);
}

//==============================
// Not yet implemented
//==============================
function deleteUser($email) {

}


?>
