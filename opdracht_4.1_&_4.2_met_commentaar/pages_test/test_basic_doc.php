<?php
require_once "_test_definitions.php";
include_once PROJECT_ROOT . "pages\basic_doc.php";
include_once PROJECT_ROOT . "page_model.php";

$model = new PageModel(NULL);
$model->page = "test_basic_doc dummy page";
$model->generateMenu();

$view = new BasicDoc($model);
$view->show();
?>
