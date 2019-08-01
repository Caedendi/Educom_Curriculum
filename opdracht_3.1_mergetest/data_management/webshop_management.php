<?php
function getCartInformation() {
  // get cart and check if filled
  if ($cart = getCart()) {
    // store all cart IDs in a new, simple array
    // and retrieve all product information from database
    foreach ($cart as $id => $amount) {
      $idList[] = $id; }
    $cartInfo = findMultipleProductsById($idList);
    // then re-add cart amounts to full product information
    foreach ($cartInfo as $key => $item) {
      $cartInfo[$key]['amount'] = $cart[$cartInfo[$key]['id']]; }
  }
  return $cartInfo;
}

function getAllProducts() {
  // needs further checks and try/catch
  try {
  $productList = findAllProducts(); // makes 1 call to database
  return $productList;
  }
  catch(Exception $e) {
    echo $e->getMessage();
    // TODO: show error page: technical error with database. webshop items cant be retrieved.
    // ---- show this in the webshop page where this function is called.
  }
}

function storeOrder() {
  $cart = getCartInformation(); // performs 1 database call
  $orderList = NULL;
  foreach ($cart as $key => $item) {
    $orderList[$key]['id'] = $item['id'];
    $orderList[$key]['quantity'] = $item['amount'];
    $orderList[$key]['price_unit'] = $item['price'];
  }
  try {
    $orderId = saveOrder(getLoggedInUserId(), $orderList); // performs 1 database call
    return $orderId;
  }
  catch(Exception $e) {
    // handle exception caused in database call by saveOrder();
    // show technical error message: order can not be saved.
  }
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
?>
