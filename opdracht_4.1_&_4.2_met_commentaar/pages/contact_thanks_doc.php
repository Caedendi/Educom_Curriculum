<?php
include_once PROJECT_ROOT . "pages\basic_doc.php";

class ContactThanksDoc extends BasicDoc {
  public function __construct($model) {
    parent::__construct($model);
  }

  protected function mainContent() {
    $this->showThanksMessage();
  }

  private function showThanksMessage() {
    echo
      "<p class='thanksMessage'>Bedankt voor uw bericht. Er zal zo spoedig mogelijk contact met u worden opgenomen.</p>" . PHP_EOL;
    echo
      "<p class='thanksMessage'>Uw verstuurde gegevens:</p>" . PHP_EOL;
    echo
      "Naam: " . $this->model->name . "<br>E-mail: " . $this->model->email . "<br>Bericht: " . $this->model->message . PHP_EOL;
  }
}
?>
