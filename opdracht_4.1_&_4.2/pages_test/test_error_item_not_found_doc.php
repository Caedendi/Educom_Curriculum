<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\\error_item_not_found_doc.php";
require_once PROJECT_ROOT . "page_model.php";

$model = new PageModel(NULL);
$model->page = "dummy not found";
$model->id = 0;

$model->generateMenu();
$view = new ItemNotFoundDoc($model);
$view->show();
?>
