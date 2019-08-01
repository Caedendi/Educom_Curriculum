<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\webshop_doc.php";
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
$model->page = "webshop";
$model->shopType = "webshop";
array_push($model->items, $testProduct);

SessionManager::loginUser(0, "Dummy1 Dummy2", "dummy@dummy.dummy");

$model->generateMenu();
$view = new WebshopDoc($model);
$view->show();
?>
