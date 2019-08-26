<?php

include_once PROJECT_ROOT . "data_management/session_manager.php";
require_once PROJECT_ROOT . "menu_item.php";

class MainMenu {
  protected $activePage;
  protected $menuItems;

  /*
   * public functions
   */
  public function __construct() {
  }

  public function show() {
    $this->showMenuStart();
    foreach ($this->menuItems as $menuItem) {
      $this->showMenuItem($menuItem);
    }
    $this->showMenuEnd();
  }

  /*
   * private functions
   */
  public function buildMeta(string $activePage) {
    $this->activePage = $activePage;
    $this->menuItems = array(
      new MenuItem("home", "HOME", "regular"),
      new MenuItem("webshop", "WEBSHOP", "regular")
    );
    if (SessionManager::isUserLoggedIn()) {
      array_push($this->menuItems,
        new MenuItem("cart", "SHOPPING CART (" . SessionManager::getItemTotalInCart() . ")", "regular"));
    }
      array_push($this->menuItems,
        new MenuItem("about", "ABOUT", "regular"));
      array_push($this->menuItems,
        new MenuItem("contact", "CONTACT", "regular"));
    if (SessionManager::isUserLoggedIn()) {
      array_push($this->menuItems,
        new MenuItem("logout", "LOGOUT [" . SessionManager::getLoggedInUserFirstName() . "]", "rightAligned"));
    }
    else {
      array_push($this->menuItems,
        new MenuItem("login", "LOGIN", "rightAligned"));
      array_push($this->menuItems,
        new MenuItem("register", "REGISTER", "rightAligned"));
    }
  }

  private function showMenuStart() {
    echo "<div class='navbar'>".PHP_EOL."<ul>" . PHP_EOL;
  }

  private function showMenuItem($menuItem) {
    echo "  <li class='" . $menuItem->class . "'><a ";
    if ($menuItem->link == $this->activePage) {
      echo "class='active' ";
    }
    echo "href='index.php?page=" . $menuItem->link . "'>" . $menuItem->label . "</a></li>" . PHP_EOL;
  }

  private function showMenuEnd() {
    echo "</ul>".PHP_EOL."</div>" . PHP_EOL . PHP_EOL;
  }
}
?>
