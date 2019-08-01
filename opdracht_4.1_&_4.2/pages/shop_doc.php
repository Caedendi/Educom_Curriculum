<?php

include_once PROJECT_ROOT . "pages\basic_doc.php";
include_once PROJECT_ROOT . "product.php";

abstract class ShopDoc extends BasicDoc {
  public function __construct($model) {
    parent::__construct($model);
  }

  protected function mainContent() {
    $this->showPreShop();
    $this->showShop();
  }

  protected function showPreShop() {
    $this->preShopStart();
    $this->preShopContent();
    $this->preShopEnd();
  }

  protected function showShop() {
    $this->shopStart();
    $this->shopType();
    $this->shopItem();
    $this->shopEnd();
  }

  protected function showAllShopItems() {
    if ($this->model->items) {
      foreach ($this->model->items as $item) {
        $this->shopItemStart();
        $this->shopItem($item);
        $this->shopItemEnd();
      }
    }
    else throw new Exception("geen producten gevonden in showItems");
  }

  private function preShopStart() {
    echo "<div class='preWebshopField'>" . PHP_EOL;
  }

  protected function preShopContent() {
    echo "<p>Pre-webshopfield dummy text.</p>" . PHP_EOL;
  }

  private function preShopEnd() {
    echo "</div> <!-- end preWebshopField -->" . PHP_EOL . PHP_EOL;  /* preWebshopField */
  }

  protected function shopStart() {
    echo "<div class='shopField'>" . PHP_EOL;
  }

  protected function shopType() {
    echo "<div class='" . $this->model->shopType . "'>" . PHP_EOL . PHP_EOL;
  }

  protected function shopEnd() {
    echo "</div> <!-- end shopType -->" . PHP_EOL . "</div> <!-- end shopField -->" . PHP_EOL . PHP_EOL;
  }

  protected function shopItemStart() {
    echo "<div class='shopItem'>" . PHP_EOL;
  }

  protected function shopItem(product $item)
  {
    echo "<p>shopitem dummy text.</p>" . PHP_EOL;
  }

  protected function shopItemEnd() {
    echo "</div> <!-- end shopItem -->" . PHP_EOL . PHP_EOL;
  }

  protected function columnStart(string $id="") {
    echo "<div class='column' id='" . $id . "'>" . PHP_EOL;
  }

  protected function columnEnd() {
    echo "</div> <!-- end column -->" . PHP_EOL;
  }

  // todo: get amount from session manager
  protected function showItemName(
    string $name,
    bool $linkToDetails=false,
    string $id=NULL,
    bool $showTotal=false)
  {
    if ($linkToDetails) {
      echo "<a class='name' href='index.php?page=details&id=" . $id . "'>".PHP_EOL."  <p class='name'>" . $name;
      if ($showTotal) {
        echo " (" . $amount . ")"; }
      echo "</p>".PHP_EOL."</a>" . PHP_EOL;
    } else {
      echo "<p class='name'>" . $name . "</p>" . PHP_EOL;
    }
  }

  protected function showItemPrice(float $price) {
    echo "<p class='price'>€" . number_format((float)$price, 2, ".", "") . "</p>" . PHP_EOL;
  }

  protected function showItemImage(
    string $image,
    string $name,
    string $size,
    string $id=NULL)
  {
    if (isset($id)) { // link to details page
      $link = 'index.php?page=details&id=' . $id;
    } else { // link to full sized image
      $link = $image;
    }

    if ($size == "small") {
      $image = str_replace(".", "_small.", $image);
    } elseif ($size == "medium") {
      $image = str_replace(".", "_medium.", $image);
    }
    echo
      "<a href='" . $link . "'>"
        .PHP_EOL."  <img src='" . SERVER_ROOT . "img/" . $image . "' alt='" . $name . ".jpg'/>"
        .PHP_EOL."</a>" . PHP_EOL;
  }

  /* later insert a script here that extends the paragraph to include $description */
  protected function showItemInfo(int $id, string $summary, string $description, bool $fullInfo=false) {
    echo "<p class='description'>" . $summary;
    if ($fullInfo) {
      echo "</p>".PHP_EOL."<p class='descriptionMore'>" . $description . "</p>" . PHP_EOL;
    } else {
      echo " <a class='more' href='index.php?page=details&id=" . $id . "'>meer info</a></p>" . PHP_EOL;
    }
  }

  // standaard (webshop, details)
  // text aantal
  // input aantal
  // knop in winkelwagen
  //
  // cart page:
  // prijs
  // input aantal
  // knop wijzig
  // knop verwijder
  protected function showItemAmount(string $id, float $price=0) {
    echo
      "<div class='amount'>
        <form method='post' action='index.php?page=" . $this->model->page . "&id=" . $id . "'>
          <input type='hidden' name='page' value='" . $this->model->page . "'>
          <input type='hidden' name='id' value='" . $id . "'>
          <label class='amount' for='amount'>Aantal: </label>
          <input class='amount' type='number' name='amount' min=1 max=999 value=1>
          <input type='submit' name='add' value='In winkelwagen'>
        </form>
      </div>" . PHP_EOL;
  }
}
?>
