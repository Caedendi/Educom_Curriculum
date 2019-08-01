<?php
require_once PROJECT_ROOT . "pages\basic_doc.php";

class HomeDoc extends BasicDoc {
  public function __construct($model) {
    // pass the data on to our parent class (BasicDoc)
    parent::__construct($model);
  }

  // Override function from basicDoc
  protected function mainContent() {
    echo
      "<p>Welkom op de homepage voor Case 1 t/m 5. </p>

      <p>Deze website is geschreven als onderdeel van het traineeship Application/
      Software Development dat wordt aangeboden door Educom. </p>

      <p>Op elke pagina vindt u links naar de pagina's waaruit deze website bestaat.
      Op de contactpagina kunt u contact met mij opnemen. Op de aboutpagina vindt
      u informatie over mijzelf.</p>" . PHP_EOL;
  }
}
?>
