<?php

function showPreWebshopFieldStart() {
  echo '
    <div class="preWebshopField">
  ';
}

function showPreWebshopFieldEnd() {
  echo '
    </div>'  /* preWebshopField */ . '
  ';
}

function showWebshopWelcomeText() {
  echo '
    <p>Welkom in de webshop.</p>
  ';
}

function showWebshopLoginText() {
  echo '
    <p>Login of registreer om te kunnen bestellen.</p>
  ';
}

function showWebshopFieldStart() {
  echo '
    <div class="webshopField">
  ';
}

function showWebshopFieldEnd() {
  echo '
      </div> ' /* webshopField */ . '
  ';
}

// TODO: insert a script that extends description to include $descriptionMore
function showWebshopItem($id, $name, $price, $image, $summary, $description, $page) {
  echo '
    <div class="webshopItem">
      <div class="webshopItemImage">
        <a href="index.php?page=details&id=' . $id . '">
          <img src="' . $image . '" alt="' . $name . '"></img>
        </a>
      </div> ' /* webshopItemImage */ . '
      <div class="webshopItemInfo">
        <a class="name" href="index.php?page=details&id=' . $id . '"><p>' . $name . '</p></a>
        <p class="description">' . $summary . ' <a class="more" href="index.php?page=details&id=' . $id . '">meer info</a></p>
        ' /* later insert a script here that extends the paragraph to include $description */ . '
      </div> ' /* webshopItemInfo */ . '
      <div class="webshopItemPrice">
        <p class="price">€' . number_format((float)$price, 2, '.', '') . '</p>
  ';
  if(isUserLoggedIn()) {
    echo '
      <div class="amount">
        <form method="post" action="index.php">
          <input type="hidden" name="page" value="' . $page . '">
          <input type="hidden" name="id" value="' . $id . '">
          <label class="amount" for="amount">Aantal: </label>
          <input class="amount" type="number" name="amount" id="' . $id . '" min=1 value=1>
          <input type="submit" name="add" value="in winkelwagen">
        </form>
      </div>
    ';
  } echo '
        </div> ' /* webshopItemPrice */ . '
      </div> ' /* webshopItem */ . '
    ';
}
?>
