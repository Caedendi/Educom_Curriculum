<?php
function showContactContent($data) {
  showContactForm($data);
}

function showContactForm($data) {
  showFormStart($data['page']);
  showFormInput('text', 'name', 'Naam:', 'uw volledige naam', $data);
  showFormInput('email', 'email', 'Email:', 'uw emailadres', $data);
  showFormInput('textarea', 'message', 'Bericht:', 'typ hier uw bericht', $data, 10, 50);
  showFormSubmit("Verstuur");
  showFormEnd();
}

function validateContactForm($data) {
  $data['name'] = testInput(getPostValue('name'));
  $data['email'] = testInput(getPostValue('email'));
  $data['message'] = testInput(getPostValue('message'));
  $data['valid'] = false;
  /* onderstaande if is niet nodig, omdat je de empty($data[...]) toch al later doet in de if's eronder */
  if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
    empty($data['name']) ? $data['nameError'] = "Name required" : $data['nameError'] = "";
    empty($data['email']) ? $data['emailError'] = "Email address required" : $data['emailError'] = "";
    empty($data['message']) ? $data['messageError'] = "Please type your message" : $data['messageError'] = "";
  }
  /* JH: in plaats van het voor de 3de keer herhalen van de test kan je ook testen of alle 'error' velden leeg zijn
         (dit helpt zeker later als je bijvoorbeeld extra toe wil voegen dat een naam alleen uit letters mag bestaan) */
  else if (!empty($data['name']) && !empty($data['email']) && !empty($data['message']))
    $data['valid'] = true;
    /* JH: Het is een goede gewoonte om bij iedere if en else een { } te plaatsen */
  return $data;
}
?>
