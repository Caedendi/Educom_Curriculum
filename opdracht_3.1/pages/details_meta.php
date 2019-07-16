<?php
function showDetailsFieldStart() {
  echo '
    <div class="detailsField">
  ';
}

function showDetailsFieldEnd() {
  echo '
    </div> ' /* detailsField */ . '
  ';
}

function showDetailsItem($id, $name, $price, $image, $summary, $description, $page) {
  echo '
    <p class="name">' . $name . '</p>
    <p class="price">€' . number_format((float)$price, 2, '.', '') . '</p>
    <div class="detailsItem">
      <div class="horizontalWrapper">
  ';
  showDetailsItemImage($image, $name);
  showDetailsItemInfo($summary, $description);
  echo '
      </div> ' /* horizontalWrapper */ . '
  ';
  showDetailsItemPrice($id, $price, $page);
  echo '
    </div> ' /* detailsItem */ . '
    ';
}

function showDetailsItemImage($image, $name) {
  echo '
    <div class="detailsItemImage">
      <a href="' . $image . '">
        <img src="' . $image . '" alt="' . $name . '"></img>
      </a>
    </div> ' /* detailsItemImage */ . '
    ';
}

function showDetailsItemInfo($summary, $description) {
  echo '
    <div class="detailsItemInfo">
      <h3>Meer informatie over dit product</h2>
      <p class="description">' . $summary . '</p>
      <p class="descriptionMore">' . $description . '</p>
    </div> ' /* detailsItemInfo */ . '
  ';
}

function showDetailsItemPrice($id, $price, $page) {
  echo '
    <div class="detailsItemPrice">
      ';
      if(isUserLoggedIn()) {
        echo '
          <div class="amount">
            <form method="post" action="index.php">
              <input type="hidden" name="page" value="' . $page . '">
              <input type="hidden" name="id" value="' . $id . '">
              <label class="amount" for="amount">Aantal: </label>
              <input class="amount" type="number" name="amount" min=1 value=1>
              <input type="submit" name="add" value="in winkelwagen">
            </form>
          </div>
          ';
      }
      echo '
    </div> ' /* detailsItemPrice */ . '
  ';
}
?>
