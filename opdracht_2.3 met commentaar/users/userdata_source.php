<?php
function connectToDatabase() {
  $server = "localhost";
  $username = "educom1";
  $password = "monitor";
  $database = "educom";
  /* JH TIP: Ik zie in de database dat je id kolom maar 5 decimalen is, dit is wel weinig, dan kan je maar 99999 users kwijt, beter om er een int(11) van te maken. */

  $link = mysqli_connect($server, $username, $password, $database);
  if (!$link) {
    throw new DatabaseConnectionException("Unable to connect to database" /* JH TIP: Voeg ook de mysqli_connect_error toe aan het bericht in de exceptie */);
    /* JH: Onderstaande debug informatie verwijderen */
    // echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    // echo "Debugging error: " . mysqli_connect_error() . "<br>";
  }
  // else echo "Verbonden" . "<br>";
  // echo "Host information: " . mysqli_get_host_info($link) . "<br>";
  return $link;
}

function findUserByEmailSql($email) { /* JH: De toevoeging Sql is niet gebruikelijk in dit soort files */
  $userData = NULL;
  try {
    $link = connectToDatabase();
    /* JH: Deze code is vatbaar voor SQL-injectie, als iemand als emailadres invult:
           "bla@bla '; DROP TABLE users; --" dan wordt de hele $sql hieronder:
           "SELECT * FROM users WHERE email = 'bla@bla'; DROP TABLE users; --'" dit wordt 
           door mysql als 2 commando's en een commentaar geinterpreteerd.

           om dit te voorkomen moet alle data die van 'buiten' de server komt worden gevalideerd
           en ontdaan van de gevaarlijke karakters met de functie "mysqli_real_escape_string"
           dus $email = mysqli_real_escape_string($link, $email);
    */
    $sql = '
      SELECT *
      FROM users
      WHERE email="'. $email . '"
    ';
    $result = mysqli_query($link, $sql);
    /* Indien deze query 'false' retourneert is het mislukt en zou je een DatabaseQueryException moeten gooien */
    $userData = mysqli_fetch_assoc($result);
    return $userData;
  }
  finally {
    mysqli_close($link);
  }
}

function saveUserToDatabase($name, $email, $password) { /* JH : idem de toevoeging ToDatabase is overbodig */
  try {
    $link = connectToDatabase();
    /* JH: Zie opmerking op regel 22 over SQL-injectie */
    $sql = '
      INSERT INTO users (email, password, name)
      VALUES ("'.$email.'", "'.$password.'", "'.$name.'")
    ';
    if (mysqli_query($link, $sql)) {
      // echo "Geregistreerd in database<br>";
      /* Indien deze query 'false' retourneert is het mislukt en zou je een DatabaseQueryException moeten gooien */
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
