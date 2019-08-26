<?php

include_once PROJECT_ROOT . "pages\\form_doc.php";

class RegisterDoc extends FormDoc {
  public function __construct($data) {
    parent::__construct($data);
  }

  protected function mainContent() {
    $this->showPreForm();
    $this->showForm();
  }

  private function showPreForm() {
    echo
      "<p>Wat leuk dat u zich wilt registreren op deze website!</p>" . PHP_EOL;
    echo
      "<p>Vul hieronder uw gegevens in en druk op verstuur. U kunt vervolgens
          inloggen met uw zojuist gemaakte account.</p>" . PHP_EOL;
  }
}
?>
