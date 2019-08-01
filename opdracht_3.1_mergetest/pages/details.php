<?php
include_once 'details_meta.php';

function showDetailsContent($data) {
  try {
    showDetailsField($data);
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
}

function prepareDetailsPage($data) {
  try {
    $data['item'] = findProductById($data['id']);
    if (empty($data['item'])) {
      $data['page'] = "error_item_not_found";
    }
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  finally {
    return $data;
  }
}

function processDetailsPage($data) {
  if (isset($_POST['add'])) {
    $data['id'] = testInput(getPostValue('id'));
    $amount = testInput(getPostValue('amount'));
    addToCart($data['id'], $amount);
  }
  return $data;
}

function showDetailsField($data) {
  showDetailsFieldStart();
  if ($data['item']) {
    showDetailsItem($data['item']['id'], $data['item']['name'], $data['item']['price'], "./img/" . $data['item']['image'], $data['item']['summary'], $data['item']['description'], $data['page']);
  }
  else {
    throw new Exception("product niet gevonden in details pagina");
  }
  showDetailsFieldEnd();
}
?>
