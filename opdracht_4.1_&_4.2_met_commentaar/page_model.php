<?php
include_once PROJECT_ROOT . "main_menu.php";

class PageModel {
  public $page;
  protected $isPost;
  public $menu;

  public function __construct($other) {
    if ($other !=NULL) {
      $this->page = $other->page;
      $this->menu = $other->menu;
      $this->isPost = $other->isPost;
    }
  }

  public function getPostValue($key, $default='') {
    $value = filter_input(INPUT_POST, $key);
    return isset($value) ? $value : $default;
  }

  public function getUrlValue($key, $default='') {
    $value = filter_input(INPUT_GET, $key);
    return isset($value) ? $value : $default;
  }

  public function getArrayValue($array, $key, $default='') {
    return isset($array[$key]) ? $array[$key] : $default;
  }

  // tests form input data for security purposes
  public function testInput($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
  }

  public function getRequestedPage() {
    $this->isPost = ($_SERVER["REQUEST_METHOD"] == "POST");
    if ($this->isPost) {
      $this->page = $this->testInput($this->getPostValue("page", "home"));
    } else {
      $this->page = $this->testInput($this->getUrlValue("page", "home"));
    }


    // if ($requestType == "POST") {
    //   $data = processPostRequest($data);
    // }
    // else if ($requestType == "GET") {
    //   $data = processGetRequest($data);
    // }
  }

  public function generateMenu() {
    $this->menu = new MainMenu();
    $this->menu->buildMeta($this->page);
  }

  public function updateMenu() {
    $this->menu->buildMeta($this->page);
  }
}
?>
