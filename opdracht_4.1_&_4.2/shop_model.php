<?php
include_once PROJECT_ROOT . "data_management/shop_database_manager.php";
require_once PROJECT_ROOT . "product.php";
require_once PROJECT_ROOT . "page_model.php";

class ShopModel extends PageModel {
  public $items = array();
  public $shopType = "noShopType";
  public $valid = false;
  public $orderId = "";

  public function __construct($pageModel) {
    parent::__construct($pageModel);
  }

  public function getUrlValues() {
    $this->id = (int)$this->testInput($this->getUrlValue('id'));
  }

  public function getCartItems() {
    // get cart and check if filled
    if (!$cart = SessionManager::getCart()) {
      return; }
    // store all cart IDs in a new, simple array
    // and retrieve all product information from database
    foreach ($cart as $id => $amount) {
      $idList[] = $id; }
    $result = ShopDatabaseManager::findMultipleEntries("products", "id", $idList);
    // then re-add cart amounts to full product information
    foreach ($result as $key => $item) {
      array_push($this->items, new Product(
        (int)$item['id'],
        $item['name'],
        $item['price'],
        $item['image'],
        $item['summary'],
        $item['description']));
    }
  }

  public function clearCart() {
    SessionManager::emptyCart();
  }

  public function processShopForm() {
    if (isset($_POST['add'])) {
      $id = $this->testInput($this->getPostValue('id'));
      $amount = $this->testInput($this->getPostValue('amount'));
      SessionManager::addToCart($id, $amount);
      $this->updateMenu();
    }
  }

  public function processDetailsForm() {
    if (isset($_POST['add'])) {
      $this->id = (int)$this->testInput($this->getPostValue('id'));
      $amount = $this->testInput($this->getPostValue('amount'));
      SessionManager::addToCart($this->id, $amount);
      $this->updateMenu();
    }
  }

  public function processCartForm() {
    if (isset($_POST['empty'])) {
      SessionManager::emptyCart();
      $this->updateMenu();
    }
    elseif (isset($_POST['modify'])) {
      $id = $this->testInput($this->getPostValue('id'));
      $amount = $this->testInput($this->getPostValue('amount'));
      SessionManager::changeAmountInCart($id, $amount);
      $this->updateMenu();
    }
    elseif (isset($_POST['remove'])) {
      $id = $this->testInput($this->getPostValue('id'));
      SessionManager::removeFromCart($id);
      $this->updateMenu();
    }
    elseif (isset($_POST['order'])) {
      if (SessionManager::isCartFilled()) {
        $this->valid = true;
      }
    }
  }

  public function calculateTotalPrice() {
    $this->priceTotal = 0;
    foreach ($this->items as $item) {
      $this->priceTotal += $item->price * SessionManager::getAmountInCart($item->id);
    }
  }

  public function getProduct(int $id) {
    $item = ShopDatabaseManager::findEntry("products", "id", $id);
    if (!empty($item)) {
      $this->items = new Product(
        (int)$item['id'],
        (string)$item['name'],
        (float)$item['price'],
        $item['image'],
        (string)$item['summary'],
        (string)$item['description']
      );
    }
    else {
      $this->items = "";
    }
  }

  public function getMultipleProducts(array $idList) {
    // needs further checks and try/catch
    try {
      $foundItems = ShopDatabaseManager::findMultipleEntries("products", "id", $idList); // makes 1 call to database
      foreach ($foundItems as $item) {
        array_push($this->items, new Product(
          (int)$item['id'],
          $item['name'],
          $item['price'],
          $item['image'],
          $item['summary'],
          $item['description'])
        );
      }
    }
    catch(Exception $e) {
      echo $e->getMessage();
      // TODO: show error page: technical error with database. webshop items cant be retrieved.
      // show this in the webshop page where this functi0n is called.
    }
  }

  public function getAllProducts() {
    $foundItems = ShopDatabaseManager::findAllEntries("products"); // makes 1 call to database
    foreach ($foundItems as $item) {
      array_push(
        $this->items,
        new Product(
          (int)$item['id'],
          $item['name'],
          $item['price'],
          $item['image'],
          $item['summary'],
          $item['description']
        )
      );
    }
  }

  public function storeOrder() {
    if (!$cart = SessionManager::getCart()) {
      throw new Exception("trying to store empty order");
    }
    // build item list to store in database
    $orderList = NULL;
    foreach ($this->items as $key => $item) {
      $orderList[$key]['id'] = $item->id;
      $orderList[$key]['quantity'] = $cart[$item->id];
      $orderList[$key]['price_unit'] = $item->price;
    }
    // save to database and remember order ID
    $this->orderId = ShopDatabaseManager::saveOrder(
      SessionManager::getLoggedInUserId(),
      $orderList); // performs 1 database call
  }





  /*
   * ========== ========== ========== ========== ==========
   * unused, unimplemented and/or untested functions
   * ========== ========== ========== ========== ==========
   */

  // TODO:

  /*
   * unimplemented and currently unused
   */
  function modifyOrder($orderId, $itemsToBeModified) {
    // $itemsToBeModified contains
    // [0] product_id, quantity, price_unit
    // check if set (price_unit) and change. if not, leave unchanged.

    // get userID from orderID and check if current logged in user == same user as order.
    // only for user modifying orders
    // should be passed for admin
    // make separate function?

    try {

    }
    catch(Exception $e) {
      echo $e->getMessage();
    }
    finally {

    }


    // check order status if modification is still possible
    // update orders table: date_modified and status
  }

  /*
   * untested and currently unused
   *
   * input = array[id]=price variables
   * gets all items from database that have matching IDs
   * then checks if current prices are different from old prices
   * store items which prices have changed als id=price
   * returns array with changed items: array[id]=price
   */
  function checkIfPricesChanged($oldPrices) {
    $changedItems = NULL;
    // get all IDs from input items
    $oldIds = array();
    foreach ($oldPrices as $id => $price) {
      $oldIds[] = $id;
    }

    // get current prices of input items
    $currentItemList = findMultipleProductsById($oldIds);
    $currentPrices = array();
    foreach ($currentItemList as $item) {
      $currentPrices[$item['id']] = $item['price'];
    }
    // compare old prices to current prices and save old price by id when changed
    foreach ($oldPrices as $id => $oldPrice) {
      if ($oldPrices[$id] != $currentPrices[$id]) {
        $changedItems[$id] = $oldPrice;
      }
    }
    return $changedItems();
  }

  /*
   * needed for checkIfPricesChanged()
   * untested and currently unused
   */
  function storeCurrentPrices($data) {
    foreach ($data['items'] as $item) {
      $data['priceList'][$item['id']] = $item['price'];
    }
    return $data;
  }

}
?>
