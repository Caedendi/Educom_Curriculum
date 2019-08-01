<?php

include_once PROJECT_ROOT . "pages\basic_doc.php";

abstract class FormDoc extends BasicDoc {

  public function __construct($model) {
    parent::__construct($model);
  }

  public function showForm() {
    $this->startForm();
    foreach ($this->model->formMeta as $formItem) {
      $this->showItem($formItem);
    }
    $this->showSubmit();
    $this->endForm();
  }

  private function startForm() {
    echo
      "<div class='formField'>
        <p class='required'>* Required field</p>
          <p class='errorMessage'></p>
        <form method='post' action='index.php'>
          <input type='hidden' name='page' value='" . $this->model->page . "'>" . PHP_EOL;
  }

  private function endForm() {
    echo
      "</form>" . PHP_EOL . "</div>" . PHP_EOL;
  }

  private function showItem($formItem, $rows=10, $columns=50) {
    echo
      "<div class='formRow'>
        <label for='" . $formItem['key'] . "'>" . $formItem['label'] . "</label>" . PHP_EOL;

    switch($formItem['type']) {
      case 'text':
      case 'email':
      case 'password':
        echo
          "<input
            class='" . $this->model->page . "'
            type='" . $formItem['type'] . "'
            name='" . $formItem['key'] . "'
            id='" . $formItem['key'] . "'
            placeholder='" . $formItem['placeholder'] . "'";
        if ($formItem['type'] == "email" || $formItem['type'] == "text") {
          echo "
            value='" . $this->model->{$formItem['key']} . "'";
        }
        echo ">" . PHP_EOL;
        break;
      case 'textarea':
        echo
          "<textarea
            class='" . $this->model->page . "'
            name='" . $formItem['key'] . "'
            id='" . $formItem['key'] . "'
            placeholder='" . $formItem['placeholder'] . "'
            rows='" . $rows . "'
            cols='" . $columns . "'>"
          . $this->model->message . PHP_EOL .
          "</textarea>" . PHP_EOL;
        break;
    }
    echo
      "<span class='required'> * " . $this->model->{$formItem['key'] . 'Error'} . "</span>" . PHP_EOL . "</div>" . PHP_EOL;
  }

  private function showSubmit() {
    echo
      "<div class='formRow'>
        <label for='submit'></label> " /* empty label */ . "
        <input type='submit' value='" . $this->model->submit . "'>
      </div>" . PHP_EOL;
  }
}
?>
