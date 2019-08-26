<?php

include_once PROJECT_ROOT . "pages\\form_doc.php";

class ContactDoc extends FormDoc {
  public function __construct($model) {
    parent::__construct($model);
  }

  protected function mainContent() {
    $this->showPreForm();
    $this->showForm();
  }

  private function showPreForm() {
    echo
      "<p>Indien u wenst contact met mij op te nemen, verzoek ik u het onderstaande
      formulier in te vullen. </p>

      <p>Gelieve alle velden in te vullen. Er zal vervolgens zo spoedig mogelijk
      contact met u worden opgenomen. </p>" . PHP_EOL;
  }
}
?>
