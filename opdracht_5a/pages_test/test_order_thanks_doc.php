<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\order_thanks_doc.php";
require_once PROJECT_ROOT . "page_model.php";

$model = new PageModel(NULL);
$model->page = "dummy thanks";
$model->orderId = 0;

$model->generateMenu();
$view = new OrderThanksDoc($model);
$view->show();
?>
