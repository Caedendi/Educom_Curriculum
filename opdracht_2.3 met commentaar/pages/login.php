<?php
function showLoginContent($data) {
  showLoginForm($data);
}

function showLoginForm($data) {
  showFormStart($data['page']);
  showFormInput('email', 'email', 'Email:', 'uw emailadres', $data);
  showFormInput('password', 'password', 'Wachtwoord:', 'uw wachtwoord', $data);
  showFormSubmit("Verstuur");
  showFormEnd();
}

function validateLoginForm($data) {
  $data['email'] = testInput(getPostValue('email'));
  $data['password'] = testInput(getPostValue('password'));
  $data['valid'] = false;
  // if either field is empty, show error
  /* JH: onderstaande if is niet nodig, omdat je de empty($data[...]) toch al later doet in de if's eronder */
  if (empty($data['email']) || empty($data['password'])) {
    empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
    empty($data['password']) ? $data['passwordError'] = "Password required" : $data['passwordError'] = "";
  }
  /* JH: test hier of alle 'error' velden leeg zijn
      (dit helpt zeker later als je bijvoorbeeld extra email validatie toe wil voegen) */
  else {
    try {
      $result = authenticateUserLogin($data['email'], $data['password']);
      if ($result) {
        $data['valid'] = $result['valid']; /* authenicateUser zou niet 'valid' horen terug te geven, dat is iets voor deze file om gewoon op true te zetten */
        $data['name'] = $result['name'];
      }
      else {
        $data['emailError'] = "Incorrect email and/or password";
      }
    }
    catch(DatabaseConnectionException $e) {
      // echo 'Message: ' . $e->getMessage();
      /* JH: Als je hier niets met de excptie doet, kan je beter de try en catch weghalen */
      throw $e;
    }
  }
  return $data;
}
?>
