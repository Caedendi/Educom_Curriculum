<?php
include_once PROJECT_ROOT . "pages\basic_doc.php";

class PageNotFoundDoc extends BasicDoc {
  public function __construct($model) {
    parent::__construct($model);
  }

  protected function mainContent() {
    echo
      "<h3>Ah oh! Er gaat ergens iets mis. </h3>

      <p>De gekozen pagina kan niet worden gevonden. </p>

      <p>Als dit probleem zich voort blijft doen, verzoeken wij u om contact met
      ons op te nemen zodat wij dit probleem kunnen verhelpen. </p>

      <p>Onze excuses voor het ongemak. </p>
      " . PHP_EOL;
  }
}
?>
