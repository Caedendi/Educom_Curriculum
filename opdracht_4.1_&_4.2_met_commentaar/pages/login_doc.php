<?php

include_once PROJECT_ROOT . "pages\\form_doc.php";

class LoginDoc extends FormDoc { /* JH: Maak FormDoc niet meer abstract en verwijder deze class */
  public function __construct($data) {
    parent::__construct($data);
  }

  protected function mainContent() {
    $this->showForm();
  }
}
?>
