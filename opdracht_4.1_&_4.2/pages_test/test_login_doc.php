<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\login_doc.php";
require_once PROJECT_ROOT . "user_model.php";

$model = new UserModel(NULL);
$model->page = "login";
$model->generateMenu();
$model->buildFormMeta();

$view = new LoginDoc($model);
$view->show();
?>
