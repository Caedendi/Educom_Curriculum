<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\details_doc.php";
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
$model->page = "details";
$model->shopType = "details";
$model->items = $testProduct;

SessionManager::loginUser(0, "Dummy1 Dummy2", "dummy@dummy.dummy");
SessionManager::addToCart(0, 5);

$model->generateMenu();
$view = new DetailsDoc($model);
$view->show();
?>
