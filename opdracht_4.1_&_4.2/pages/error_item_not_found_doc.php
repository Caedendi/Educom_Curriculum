<?php
include_once PROJECT_ROOT . "pages\basic_doc.php";

class ItemNotFoundDoc extends BasicDoc {
  public function __construct($model) {
    parent::__construct($model);
  }

  protected function mainContent() {
    echo
      "<h3>Ah oh! Er gaat ergens iets mis. </h3>

      <p>Het product dat u zoekt lijkt zich niet (meer) in ons assortiment te bevinden. </p>

      <p>Als u dit product terug wilt zien in ons assortiment, kunt u een hiervoor
         aanvraag indienen middels de contactpagina. Gelieve hierbij het
         productnummer (" . $this->model->id . ") te vermelden. </p>

      <p>Onze excuses voor het ongemak.</p>" . PHP_EOL;
  }
}
?>
