<?php
require_once PROJECT_ROOT . "page_controller.php";
include_once PROJECT_ROOT . "shop_model.php";

class ShopController extends PageController {
  private $model;

  public function __construct($pageModel) {
    $this->model = new ShopModel($pageModel);
  }

  public function handleWebshop() {
    $this->model->shopType = "webshop";
    $this->model->processShopForm();
    $this->model->getAllProducts();
    $view = new WebshopDoc($this->model);
    $view->show();
  }

  public function handleDetails() {
    $this->model->shopType = "details";
    $this->model->processDetailsForm();
    $this->model->getUrlValues();
    $this->model->getProduct($this->model->id);
    if (!empty($this->model->items)) {
      $view = new DetailsDoc($this->model); }
    else {
      $this->model->page = "item not found";
      $view = new ItemNotFoundDoc($this->model);
    }

    $view->show();
  }

  public function handleCart() {
    $this->model->shopType = "cart";
    $this->model->processCartForm();
    $view = new CartDoc($this->model);
    try {
      if ($this->model->valid) {
        $this->model->getCartItems();
        $this->model->storeOrder();
        $this->model->clearCart();
        $this->model->page = "orderThanks";
        $this->model->updateMenu();
        $view = new OrderThanksDoc($this->model);
      }
      else if (SessionManager::isCartFilled()) {
        $this->model->getCartItems();
        $this->model->calculateTotalPrice();
      }
      $view->show();
    }
    catch(Exception $e) {
      // wat als orderverwerking mislukt
      // foutpagina
    }
  }
}
?>
