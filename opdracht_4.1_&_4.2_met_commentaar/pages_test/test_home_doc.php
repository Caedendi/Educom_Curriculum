<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\home_doc.php";
require_once PROJECT_ROOT . "page_model.php";

$model = new PageModel(NULL);
$model->page = "home";

$model->generateMenu();
$view = new HomeDoc($model);
$view->show();
?>
