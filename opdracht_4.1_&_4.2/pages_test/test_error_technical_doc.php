<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\\error_technical_doc.php";
require_once PROJECT_ROOT . "page_model.php";

$model = new PageModel(NULL);
$model->page = "dummy technical";

$model->generateMenu();
$view = new TechnicalErrorDoc($model);
$view->show();
?>
