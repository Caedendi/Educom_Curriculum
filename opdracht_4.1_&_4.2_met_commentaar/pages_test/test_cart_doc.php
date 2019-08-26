<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\cart_doc.php";
require_once PROJECT_ROOT . "shop_model.php";
require_once PROJECT_ROOT . "product.php";

$testProduct = new Product(
  0,
  "TEST PRODUCT",
  123.45,
  "dummy.png",
  "summary dummy text",
  "description dummy text"
);

$model = new ShopModel(NULL);
$model->page = "cart";
$model->shopType = "cart";
array_push($model->items, $testProduct);

SessionManager::loginUser(0, "Dummy1 Dummy2", "dummy@dummy.dummy");
SessionManager::addToCart(0, 5);
$model->calculateTotalPrice();

$model->generateMenu();
$view = new CartDoc($model);
$view->show();
?>
