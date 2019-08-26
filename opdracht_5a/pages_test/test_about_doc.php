<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\about_doc.php";
require_once PROJECT_ROOT . "page_model.php";

$model = new PageModel(NULL);
$model->page = "about";

$model->generateMenu();
$view = new AboutDoc($model);
$view->show();
?>
