<?php
include_once 'cart_meta.php';

function showCartContent($data) {
  showPreCartField($data);
  if (isUserLoggedIn() && isCartFilled()) {
    showCartField($data);
  }
}

function processCartPage($data) {
  if (isset($_POST['empty'])) {
    emptyCart();
  }
  elseif (isset($_POST['modify'])) {
    $id = testInput(getPostValue('id'));
    $amount = testInput(getPostValue('amount'));
    changeAmountInCart($id, $amount);
  }
  elseif (isset($_POST['remove'])) {
    $id = testInput(getPostValue('id'));
    removeFromCart($id);
  }
  elseif (isset($_POST['order'])) {
    // $priceList = testInput(getPostValue('priceList'));
    // $changedPrices = checkIfPricesChanged($priceList);
    $data['orderId'] = storeOrder();
    if ($data['orderId']) {
      $data['page'] = 'order_Thanks';
      emptyCart();
    }
  }
  return $data;
}

function prepareCartPage($data) {
  if (isCartFilled()) {
  $data['items'] = getCartInformation();
  // $data = storeCurrentPrices($data);
  }
  return $data;
}

function showPreCartField($data) {
  showPreCartFieldStart();
  if (!isUserLoggedIn()) {
    showCartLoginText();
  } else
  if (isset($data['items'])) {
    showCartIsNotEmptyText();
  } else {
    showCartIsEmptyText();
  }
  showPreCartFieldEnd();
}

function showCartField($data) {
  showCartFieldStart($data);
  showAllCartItems($data);
  // showVoucherField($data);
  showTotalField($data);
  showCartFieldEnd($data);
}

function showAllCartItems($data) {
  foreach ($data['items'] as $item) {
    showCartItem($item['id'], $item['name'], $item['price'], "./img/" . $item['image'], $item['summary'], $item['amount'], $data['page']); //, $data['page']);
  }
  // else throw new Exception("geen producten gevonden in showItems");
}

function calculateTotalPrice($data) {
  $data['priceTotal'] = 0;
  foreach ($data['items'] as $item) {
    $data['priceTotal'] += $item['price'] * $item['amount'];
  }
  return $data;
}
?>
