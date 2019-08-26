<?php
class MenuItem {
  public $link;
  public $label;
  public $class;

  public function __construct(
    string $link,
    string $label,
    string $class)
  {
    $this->link = $link;
    $this->label = $label;
    $this->class = $class;
  }
}
?>
