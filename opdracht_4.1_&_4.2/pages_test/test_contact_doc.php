<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\contact_doc.php";
require_once PROJECT_ROOT . "user_model.php";

$model = new UserModel(NULL);
$model->page = "contact";
$model->generateMenu();
$model->buildFormMeta();

$view = new ContactDoc($model);
$view->show();
?>
