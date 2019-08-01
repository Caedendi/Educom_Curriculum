<?php
function showPreCartFieldStart() {
  echo '
    <div class="preCartField">
  ';
}

function showPreCartFieldEnd() {
  echo '
    </div>' /* preCartField */ . '
  ';
}

function showCartLoginText() {
  echo '
    <p>Gelieve in te loggen als u gebruik wilt maken van de webshop.</p>
  ';
}

function showCartIsEmptyText() {
  echo '
    <p>Uw winkelwagen is leeg.</p>
  ';
}

function showCartIsNotEmptyText() {
  echo '
    <p>U heeft de volgende artikelen in uw winkelwagen.</p>
    <p>Druk op bevestigen om naar de volgende stap in het bestelproces te gaan.</p>
  ';
}

function showCartFieldStart($data) {
  echo '
      <div class="cartField">
        <form method="post" action="index.php">
          <input type="hidden" name="page" value="' . $data['page'] . '">
          <input type="submit" name="empty" id="empty" value="Verwijder alle artikelen">
        </form>
  ';
}

function showCartFieldEnd($data) {
  echo '
    <form method="post" action="index.php">
      <input type="hidden" name="page" value="' . $data['page'] . '">
    ' /*
  ';
  foreach ($data['priceList'] as $id => $price) {
    echo '
      <input type="hidden" name="' . $data['priceList'][$id] . '" value="' . $price . '">
    ';
  }
  echo ' */ . '
        <input type="submit" name="order" id="order" value="bevestigen">
      </form>
    </div> ' /* cartField */ . '
  ';
}

function showCartItem($id, $name, $price, $image, $summary, $amount, $page) {
  echo '
    <div class="cartItem">
      <div class="cartItemImage">
        <a href="index.php?page=details&id=' . $id . '">
          <img src="' . $image . '" alt="' . $name . '"></img>
        </a>
      </div> ' /* cartItemImage */ . '
      <div class="cartItemAmount">
        <a class="name" href="index.php?page=details&id=' . $id . '"><p>' . $name . ' (' . $amount . ')</p></a>
        <div class="amount">
          <form method="post" action="index.php">
            <input type="hidden" name="page" value="' . $page . '">
            <input type="hidden" name="id" value="' . $id . '">
            <label class="amount" for="amount">€' . $price . '</label>
            <input class="amount" type="number" name="amount" min=0 value=' . $amount . '>
            <input type="submit" name="modify" value="wijzig">
            <input type="submit" name="remove" value="verwijder">
          </form>
        </div>
        ' /* later insert a script here that extends the paragraph to include $description */ . '
      </div> ' /* cartItemInfo */ . '
      <div class="cartItemPrice">
        <p class="price">Subtotaal: €' . number_format(($amount * (float)$price), 2, '.', '') . '</p>
      </div> ' /* cartItemPrice */ . '
    </div> ' /* cartItem */ . '
  ';
}

/*
 * unused and unfinished
 */
function showVoucherField($data) {
  // grijs veld, links naast total field met textveld, toevoegknop
  // error code onder veld als niet goed
  echo '
    <div class="voucherField">
      <div class="voucherInput">
        <form method="post" action="index.php">
          <input type="hidden" name="page" value="' . $data['page'] . '">
          <input class="voucher" type="text" name="code" value="Kortingscode">
          <input type="submit" name="voucher" value="voeg toe">
        </form>
      </div>
    </div>
  ';
}

function showTotalField($data) {
  /*
   * grijs veld,
   * align rechts,
   * show item total,
   * bezorgkosten,
   * BTW,
   * totaalprijs,
   * bestelknop
   */

  $data = calculateTotalPrice($data);
  echo '
    <div class="totalField">
      <div class="totalContents">
        <p class="total">Totaalprijs: €' . $data['priceTotal'] . '</p>
      </div> ' /* totalContents */ . '
    </div> ' /* totalField */ . '
  ';
}

?>
