<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\\register_doc.php";
require_once PROJECT_ROOT . "user_model.php";

$model = new UserModel(NULL);
$model->page = "register";
$model->generateMenu();
$model->buildFormMeta();

$view = new RegisterDoc($model);
$view->show();
?>
