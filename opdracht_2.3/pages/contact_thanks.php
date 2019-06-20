<?php
function showThanksContent($data) {
  echo '
    <!-- Shows all entered input if input is correct -->
    <p class="thanksMessage">Bedankt voor uw bericht. Er zal zo spoedig mogelijk contact met u worden opgenomen.<br><br></p>
    <p class="thanksMessage">Uw verstuurde gegevens:<br><br>
      Naam: ' . getArrayValue($data, "name") . '<br>
      E-mail: ' . getArrayValue($data, "email") . '<br>
      Bericht: ' . getArrayValue($data, "message") . '
  ';
}
?>
