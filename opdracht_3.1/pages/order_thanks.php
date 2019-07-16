<?php
function showOrder_ThanksContent($data) {
  echo '
    <p class="thanksMessage">Bedankt voor uw bestelling.</p>
    <p class="thanksMessage">Uw ordernummer is:<br><br>
      ' . getArrayValue($data, "orderId") . '<br>
  ';
}
?>
