<?php
function showError_Item_Not_FoundContent($data) {
  echo '
    <h3>Ah oh! Er gaat ergens iets mis.</h3>
    <p>Het gekozen product lijkt zich niet (meer) in ons assortiment te bevinden.</p>
    <p>Als u dit product terug wilt zien in ons assortiment, kunt u een hiervoor
       aanvraag indienen middels de contactpagina. Gelieve hierbij het
       productnummer (' . $data['id'] . ') te vermelden.
    </p>
    <p>Onze excuses voor het ongemak.</p>
  ';
}
?>
