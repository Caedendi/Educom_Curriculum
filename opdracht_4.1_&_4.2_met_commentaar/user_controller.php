<?php
require_once PROJECT_ROOT . "page_controller.php";
include_once PROJECT_ROOT . "user_model.php";

class UserController extends PageController {
  private $model;

  public function __construct($pageModel) {
    $this->model = new UserModel($pageModel);
  }

  public function handleContactForm() {
    $this->model->validateContactForm();
    if ($this->model->valid) {
      $view = new ContactThanksDoc($this->model);
    }
    else {
      $this->model->buildFormMeta();
      $view = new ContactDoc($this->model);
    }
    $view->show();
  }

  public function handleRegister() {
    // implement try/catch, else show page technical error
    $this->model->validateRegisterForm();
    if ($this->model->valid) {
      $this->model->storeUser();
      $this->model->page = "login";
      // storeUser($data['name'], $data['email'], $data['password']);
      $this->model->buildFormMeta();
      $view = new LoginDoc($this->model);
    }
    else {
      $this->model->buildFormMeta();
      $view = new RegisterDoc($this->model);
    }
    $view->show();
  }

  public function handleLogin() {
    $this->model->validateLoginForm();
    try {
      if ($this->model->valid) {
        $this->model->authenticateUser();
      }
      if ($this->model->valid) {
        $this->model->loginUser();
        $this->model->page = "home";
        $view = new HomeDoc($this->model);
      }
      else {
        $this->model->buildFormMeta();
        $view = new LoginDoc($this->model);
      }
      $view->show();
    }
    catch(Exception $e) {
      // TODO: exception handling for authenticateUser
      /* JH: Fill in todo */
    }
  }

  public function handleLogout() {
    $this->model->logoutUser();
    $view = new HomeDoc($this->model);
    $view->show();
  }


} // end class
?>
