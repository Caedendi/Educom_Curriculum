<?php
function showMenu($page) {
  echo '
    <div class="navbar">
      <ul>
        <li><a ';
        if($page=='home') { echo 'class="active" '; }
        echo 'href="index.php?page=home">HOME</a></li>
        <li><a ';
        if($page=='about') { echo 'class="active" '; }
        echo 'href="index.php?page=about">ABOUT</a></li>
        <li><a ';
        if($page=="contact") { echo 'class="active" '; }
        echo 'href="index.php?page=contact">CONTACT</a></li>
      </ul>
    </div>
  ';
}
?>
