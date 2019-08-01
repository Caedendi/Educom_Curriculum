<?php
include_once 'webshop_meta.php';

function showWebshopContent($data) {
  showPreWebshopField();
  showWebshopField($data);
}

function prepareWebshopPage($data) {
  $data['items'] = findAllProducts();
  return $data;
}

function processWebshopPage() {
  if (isset($_POST['add'])) {
    $id = testInput(getPostValue('id'));
    $amount = testInput(getPostValue('amount'));
    addToCart($id, $amount);
  }
}

function showPreWebshopField() {
  showPreWebshopFieldStart();
  showWebshopWelcomeText();
  if (!isUserLoggedIn()) {
    showWebshopLoginText();
  }
  showPreWebshopFieldEnd();
}

function showWebshopField($data) {
  showWebshopFieldStart();
  showAllWebshopItems($data);
  showWebshopFieldEnd();
}

function showAllWebshopItems($data) {
  if ($data['items']) {
    foreach ($data['items'] as $item) {
      showWebshopItem($item['id'], $item['name'], $item['price'], "./img/" . $item['image'], $item['summary'], $item['description'], $data['page']);
    }
  }
  else throw new Exception("geen producten gevonden in showItems");
}
?>
