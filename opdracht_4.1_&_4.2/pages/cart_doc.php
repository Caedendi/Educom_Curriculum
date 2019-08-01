<?php

include_once PROJECT_ROOT . "pages\shop_doc.php";
include_once PROJECT_ROOT . "data_management\session_manager.php";

class CartDoc extends ShopDoc {
  public function __construct($model) {
    parent::__construct($model);
    $this->model->shopType = "cart";
  }

  protected function mainContent() {
    $this->showPreShop();
    if (SessionManager::isUserLoggedIn() && SessionManager::isCartFilled()) {
      $this->showShop();
    }
  }

  protected function preShopContent() {
    if (!SessionManager::isUserLoggedIn()) {
      $this->loginText(); }
    else {
      if (SessionManager::isCartFilled()) {
        $this->cartNotEmptyText(); }
      else {
        $this->cartEmptyText(); }
    }
  }

  protected function showShop() {
      $this->shopStart();
      $this->shopType();
      $this->showEmpty();
      $this->showAllShopItems();
      // $this->showVoucherField();
      $this->showTotalField();
      $this->showSubmit();
      $this->shopEnd();
  }

  private function loginText() {
    echo
      "<p>Gelieve in te loggen als u gebruik wilt maken van de webshop.</p>" . PHP_EOL;
  }

  private function cartEmptyText() {
    echo
      "<p>Uw winkelwagen is leeg.</p>" . PHP_EOL;
  }

  private function cartNotEmptyText() {
    echo
      "<p>U heeft de volgende artikelen in uw winkelwagen.</p>" . PHP_EOL;
    echo
      "<p>Druk op bevestigen om naar de volgende stap in het bestelproces te gaan.</p>" . PHP_EOL;
  }

  private function showEmpty() {
    echo
      "<form method='post' action='index.php?page=cart'>
        <input type='hidden' name='page' value='" . $this->model->page . "'>
        <input type='submit' name='empty' id='empty' value='Verwijder alle artikelen'>
      </form>" . PHP_EOL;
  }

  protected function shopItem(product $item) {
    $this->columnStart("left");
      $this->showItemImage($item->image, $item->name, "small", $item->id);
    $this->columnEnd();
    $this->columnStart("mid");
      $this->showItemName($item->name, true, $item->id, false);
      $this->showItemAmount($item->id, $item->price);
    $this->columnEnd();
    $this->columnStart("right");
      $this->showSubtotalPrice($item->id, $item->price);
    $this->columnEnd();
  }

  protected function showItemAmount(string $id, float $price=0) {
    echo
      "<form method='post' action='index.php'>
        <input type='hidden' name='page' value='" . $this->model->page . "'>
        <input type='hidden' name='id' value='" . $id . "'>
        <label class='amount' for='amount'>€" . $price . "</label>
        <input class='amount' type='number' name='amount' min=0 max=999 value=" . SessionManager::getAmountInCart($id) . ">
        <input type='submit' name='modify' value='Wijzig'>
        <input type='submit' name='remove' value='Verwijder'>
      </form>" . PHP_EOL;
  }

  protected function showSubtotalPrice(int $id, float $price) {
    echo
      "<p class='price'>Subtotaal:<br>€" . number_format((SessionManager::getAmountInCart($id) * (float)$price), 2, ".", "") . "</p>" . PHP_EOL;
  }

  /*
   * unused and unfinished
   */
  private function showVoucherField($data) {
    // grijs veld, links naast total field met textveld, toevoegknop
    // error code onder veld als niet goed
    echo '
      <div class="voucherField">
        <div class="voucherInput">
          <form method="post" action="index.php">
            <input type="hidden" name="page" value="' . $this->model->page . '">
            <input class="voucher" type="text" name="code" value="Kortingscode">
            <input type="submit" name="voucher" value="voeg toe">
          </form>
        </div>
      </div>
    ';
  }

  private function showTotalField() {
    echo
      "<div class='totalField'>
          <p class='total'>Totaalprijs: €" . $this->model->priceTotal . "</p>
      </div>" . PHP_EOL;
  }

  private function showSubmit() {
    echo
      "<form method='post' action='index.php'>
        <input type='hidden' name='page' value='" . $this->model->page . "'>
          <input type='submit' name='order' id='order' value='Bevestigen'>
      </form>" . PHP_EOL;
  }
}
?>
