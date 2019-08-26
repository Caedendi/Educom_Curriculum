<?php
include_once PROJECT_ROOT . "data_management/user_database_manager.php";
require_once PROJECT_ROOT . "page_model.php";

class UserModel extends PageModel {
  public $id = "";
  public $name = "";
  public $nameError = "";
  public $email = "";
  public $emailError = "";
  public $password = "";
  public $passwordError = "";
  public $passwordRepeat = "";
  public $passwordRepeatError = "";
  public $message = "";
  public $messageError = "";
  public $valid = false;
  public $formMeta = "";
  public $submit = "";

  public function __construct($pageModel) {
    parent::__construct($pageModel);
  }

  public function loginUser() {
    if (!empty($this->id) && !empty($this->name) && !empty($this->email)) {
      $this->page = "home";
      SessionManager::loginUser($this->id, $this->name, $this->email);
      $this->updateMenu();
    }
    else {
      echo "can't login." . PHP_EOL;
      return;
    }
  }

  public function storeUser() {
    if (!$this->isEmailKnown($this->email)) {
      UserDatabaseManager::saveUser($this->name, $this->email, $this->password); }
  }

  public function logoutUser() {
    $this->page = "home";
    SessionManager::logoutUser();
    $this->updateMenu();
  }

  public function isEmailKnown(string $email) {
    if (empty($email)) return false;
    $searchResult = UserDatabaseManager::findUserByEmail($email);
    if (empty($searchResult)) {
      return false; }
    else return true;
  }

  public function validateContactForm() {
    if (!$this->isPost) {
      return;
    }
    $this->name = $this->testInput($this->getPostValue('name'));
    $this->email = $this->testInput($this->getPostValue('email'));
    $this->message = $this->testInput($this->getPostValue('message'));
    $this->valid = false;

    empty($this->name) ?
      $this->nameError = "Name required" :
      $this->nameError = "";
    empty($this->email) ?
      $this->emailError = "Email address required" :
      $this->emailError = "";
    empty($this->message) ?
      $this->messageError = "Please type your message" :
      $this->messageError = "";

    if (empty($this->nameError)
     && empty($this->emailError)
     && empty($this->messageError)) {
      $this->valid = true; }
  }

  public function validateRegisterForm() {
    if (!$this->isPost) {
      return;
    }
    $this->name = $this->testInput($this->getPostValue('name'));
    $this->email = $this->testInput($this->getPostValue('email'));
    $this->password = $this->testInput($this->getPostValue('password'));
    $this->passwordRepeat = $this->testInput($this->getPostValue('passwordRepeat'));
    $this->valid = false;

    empty($this->name) ?
      $this->nameError = "Name required" :
      $this->nameError = "";
    empty($this->email) ?
      $this->emailError = "Email address required" :
      $this->emailError = "";
    empty($this->password) ?
      $this->passwordError = "Password required" :
      $this->passwordError = "";
    empty($this->passwordRepeat) ?
      $this->passwordRepeatError = "Please repeat password" :
      $this->passwordRepeatError = "";

    if ($this->password != $this->passwordRepeat) {
      $this->passwordError = "Passwords do not match"; }

    // if all fields filled & passwords match, then check if email already registered
    // yes? show register error
    // no? set register is valid
    else if ((empty($this->nameError)
           && empty($this->emailError)
           && empty($this->passwordError)
           && empty($this->passwordRepeatError))
           && ($this->password == $this->passwordRepeat)) {
      if (!$this->isEmailKnown($this->email)) {
        $this->valid = true; }
      else {
        $this->emailError = "Email address already registered"; }
    }
  }

  public function validateLoginForm() {
    if (!$this->isPost) {
      return;
    }
    $this->email = $this->testInput($this->getPostValue('email'));
    $this->password = $this->testInput($this->getPostValue('password'));
    $this->valid = false;

    // if either field is empty, an error message will be shown
    empty($this->email) ? $this->emailError = "Email address required" : $this->emailError = "";
    empty($this->password) ? $this->passwordError = "Password required" : $this->passwordError = "";

    // authentication will only happen if there are no error messages
    if (empty($this->emailError) && empty($this->passwordError)) {
      $this->valid = true;
    }
  }

  public function authenticateUser() {
    $this->valid = false;
    $searchResult = UserDatabaseManager::findUserByEmail($this->email);
    if ($searchResult['password'] == $this->password) {
      $this->id = $searchResult['id'];
      $this->name = $searchResult['name'];
      $this->valid = true;
    }
    else {
      $this->emailError = "Incorrect email and/or password";
    }
  }

  public function buildFormMeta() {
    switch ($this->page) {
      case "contact":
        $this->formMeta = array(
          array('type' => "text", 'key' => "name", 'label' => "Naam:", 'placeholder' => "uw volledige naam"),
          array('type' => "email", 'key' => "email", 'label' => "Email:", 'placeholder' => "uw emailadres"),
          array('type' => "textarea", 'key' => "message", 'label' => "Bericht:", 'placeholder' => "typ hier uw bericht")
        );
        $this->submit = "Verstuur";
        break;
      case "register":
        $this->formMeta = array(
          array('type' => "text", 'key' => "name", 'label' => "Naam:", 'placeholder' => "uw volledige naam"),
          array('type' => "email", 'key' => "email", 'label' => "Email:", 'placeholder' => "uw emailadres"),
          array('type' => "password", 'key' => "password", 'label' => "Wachtwoord:", 'placeholder' => "uw wachtwoord"),
          array('type' => "password", 'key' => "passwordRepeat", 'label' => "Herhaal wachtwoord:", 'placeholder' => "herhaal wachtwoord")
        );
        $this->submit = "Registreer";
        break;
      case "login":
        $this->formMeta = array(
          array('type' => "email", 'key' => "email", 'label' => "Email:", 'placeholder' => "uw emailadres"),
          array('type' => "password", 'key' => "password", 'label' => "Wachtwoord:", 'placeholder' => "uw wachtwoord")
        );
        $this->submit = "Login";
        break;
    }
  }
}
?>
