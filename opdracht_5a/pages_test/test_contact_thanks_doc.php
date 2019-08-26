<?php
require_once "_test_definitions.php";
require_once PROJECT_ROOT . "pages\contact_thanks_doc.php";
require_once PROJECT_ROOT . "page_model.php";

$model = new PageModel(NULL);
$model->page = "contact";
$model->name = "Dummy1 Dummyname";
$model->email = "dummy@dummy.dummy";
$model->message = "Dummy message for contact thanks doc";

$model->generateMenu();
$view = new ContactThanksDoc($model);
$view->show();
?>
