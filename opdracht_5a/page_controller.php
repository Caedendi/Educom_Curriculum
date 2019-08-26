<?php
include_once PROJECT_ROOT . "page_model.php";
include_once PROJECT_ROOT . "user_controller.php";
include_once PROJECT_ROOT . "shop_controller.php";
include_once PROJECT_ROOT . "pages/_pages.php";

include_once PROJECT_ROOT . "data_management/session_manager.php";

class PageController {
  private $model;

  public function __construct() {
    $this->model = new PageModel(NULL);
  }

  public function handleRequest() {
    $this->model->getRequestedPage();
    $this->model->generateMenu();

    switch ($this->model->page) {
      case "home":
        $view = new HomeDoc($this->model);
        $view->show();
        break;
      case "about":
        $view = new AboutDoc($this->model);
        $view->show();
        break;
      case "contact":
        $controller = new UserController($this->model);
        $controller->handleContactForm();
        break;
      case "register":
        $controller = new UserController($this->model);
        $controller->handleRegister();
        break;
      case "login":
        $controller = new UserController($this->model);
        $controller->handleLogin();
        break;
      case "webshop":
        $controller = new ShopController($this->model);
        $controller->handleWebshop();
        break;
      case "details":
        $controller = new ShopController($this->model);
        $controller->handleDetails();
        break;
      case "cart":
        $controller = new ShopController($this->model);
        $controller->handleCart();
        break;
      case "logout":
        $controller = new UserController($this->model);
        $controller->handleLogout();
        break;
      case "technical error":
        $view = new TechnicalErrorDoc($this->model);
        $view->show();
        break;
      default:
        $this->model->page = "page not found";
        $view = new PageNotFoundDoc($this->model);
        $view->show();
        break;
    }
  }
}
?>
