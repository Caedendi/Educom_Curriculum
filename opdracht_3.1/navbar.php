<?php
function showMenu($data) {
  showMenuStart();
  foreach ($data['menu'] as $menuItem) {
    showMenuItem($menuItem, $data['page']);
  }
  showMenuEnd();
}

function showMenuStart() {
  echo '
    <div class="navbar">
      <ul>
  ';
}

function showMenuEnd() {
  echo '
      </ul>
    </div>
  ';
}

function showMenuItem($menuItem, $currentPage) {
  echo '
    <li class="' . $menuItem['class'] . '"><a ';
      if ($currentPage == $menuItem['link']) { echo 'class="active" '; }
      echo 'href="index.php?page=' . $menuItem['link'] . '">' . $menuItem['label'] . '</a></li>
  ';
}
?>
