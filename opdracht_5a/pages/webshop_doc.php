<?php
include_once PROJECT_ROOT . "pages\shop_doc.php";
include_once PROJECT_ROOT . "data_management\session_manager.php";

class WebshopDoc extends ShopDoc {
  public function __construct($model) {
    parent::__construct($model);
  }

  protected function preShopContent() {
    $this->welcomeText();
    if (!SessionManager::isUserLoggedIn()) {
      $this->loginText();
    }
  }

  private function welcomeText() {
    echo "<p>Welkom in de webshop.</p>" . PHP_EOL;
  }

  private function loginText() {
    echo "<p>Login of registreer om te kunnen bestellen.</p>" . PHP_EOL;
  }

  protected function showShop() {
    $this->shopStart();
    $this->shopType();
    $this->showAllShopItems();
    $this->shopEnd();
  }

  // TODO: insert a script that extends description to include $descriptionMore
  protected function shopItem(product $item)
  {
    $this->columnStart("left");
      $this->showItemImage($item->image, $item->name, "small", $item->id);
    $this->columnEnd();
    $this->columnStart("mid");
      $this->showItemName($item->name, true, $item->id, false);
      $this->showItemRating($item->rating, $item->id);
      $this->showItemInfo($item->id, $item->summary, $item->description, false);
    $this->columnEnd();
    $this->columnStart("right");
      $this->showItemPrice($item->price);
      if (SessionManager::isUserLoggedIn()) {
        $this->showItemAmount($item->id, $item->price); }
    $this->columnEnd();
  }
}
?>
