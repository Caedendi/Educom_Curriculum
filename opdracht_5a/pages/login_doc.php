<?php

include_once PROJECT_ROOT . "pages\\form_doc.php";

class LoginDoc extends FormDoc {
  public function __construct($data) {
    parent::__construct($data);
  }

  protected function mainContent() {
    $this->showForm();
  }
}
?>
