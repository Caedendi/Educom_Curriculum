<?php
function showThanksContent($data) {
  echo '
    <!-- Shows all entered input if input is correct -->
    <p class="thanksMessage">Bedankt voor uw bericht. Er zal zo spoedig mogelijk contact met u worden opgenomen.</p>
    <p class="thanksMessage">Uw verstuurde gegevens:<br>
      Naam: ' . $data['name'] . '<br>
      E-mail: ' . $data['email'] . '<br>
      Bericht: ' . $data['message'] . '
  ';
}
?>
