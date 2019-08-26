<?php

include_once PROJECT_ROOT . "pages\shop_doc.php";
include_once PROJECT_ROOT . "data_management\session_manager.php";

class DetailsDoc extends ShopDoc {
  public function __construct($model) {
    parent::__construct($model);
  }

  protected function mainContent() {
    if (!SessionManager::isUserLoggedIn()) {
      $this->showPreShop(); }
    $this->showShop();
  }

  protected function preShopContent() {
    if (!SessionManager::isUserLoggedIn()) {
      $this->loginText();
    }
  }

  private function loginText() {
    echo "<p>Login of registreer om te kunnen bestellen.</p>" . PHP_EOL;
  }

  private function moreInfoHeaderText() {
    echo "<h3>Meer informatie over dit product</h3>" . PHP_EOL;
  }

  protected function showShop() {
      $this->shopStart();
      $this->shopType();
      $this->shopItem($this->model->items);
      $this->shopEnd();
  }

  protected function shopItem(product $item)
  {
    $this->showItemName($item->name, false, NULL, false);
    $this->showItemPrice($item->price);
    $this->shopItemStart();
      $this->columnStart("left");
        $this->showItemImage($item->image, $item->name, "medium");
        if (SessionManager::isUserLoggedIn()) {
          $this->showItemAmount($item->id); }
      $this->columnEnd();
      $this->columnStart("right");
        $this->moreInfoHeaderText();
        $this->showItemRating($item->rating, $item->id);
        $this->showItemInfo($item->id, $item->summary, $item->description, true);
      $this->columnEnd();
      $this->columnStart("bottom");
      $this->showItemReview($this->model->userRating);
      $this->columnEnd();
    $this->shopItemEnd();
  }
}
?>
