<?php
include_once PROJECT_ROOT . "pages\basic_doc.php";

class OrderThanksDoc extends BasicDoc {
  public function __construct($model) {
    parent::__construct($model);
  }

  protected function mainContent() {
    $this->showThanksMessage();
  }

  private function showThanksMessage() {
    echo
      "<p class='thanksMessage'>Bedankt voor uw bestelling.</p>" . PHP_EOL;
    echo
      "<p class='thanksMessage'>Uw ordernummer is:" . PHP_EOL;
    echo $this->model->orderId . PHP_EOL;
  }
}
?>
