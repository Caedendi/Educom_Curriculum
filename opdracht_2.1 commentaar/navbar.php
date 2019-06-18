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
  /* JH: Het valt je misschien op dat er veel herhaling zit in bovenstaande code,
         Misschien kan je een functie showMenuItem($link, $label, $page) (en eventueel een showMenuStart() en showMenuEnd()) maken 
         die je kan gebruiken als:

         function showMenu($page) {
            showMenuStart();
            showMenuItem('home', 'HOME', $page);
            showMenuItem('about', 'ABOUT', $page);
            showMenuItem('contact', 'CONTACT', $page);
            showMenuEnd();
         }
  */
}
?>
