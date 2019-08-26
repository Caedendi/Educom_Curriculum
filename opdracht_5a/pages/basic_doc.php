<?php
require_once PROJECT_ROOT . "pages\html_doc.php";
require_once PROJECT_ROOT . "main_menu.php";

class BasicDoc extends HtmlDoc {
  protected $model;

  public function __construct($model) {
    $this->model = $model;
  }

  protected function title() {
    echo "<title>My website - " . $this->model->page . "</title>" . PHP_EOL;
  }

  private function metaAuthor() {
    echo "<meta name='author' content='Bart Commandeur'>" . PHP_EOL;
  }

  private function cssLinks() {
    echo "<link rel='stylesheet' type='text/css' href='" . SERVER_ROOT . "css/FirstExternalSheet.css'>" . PHP_EOL;
  }

  private function javaScript() {
    echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>" . PHP_EOL;
    echo "<script src='" . SERVER_ROOT . "scripts/textReveal.js'></script>" . PHP_EOL;
    echo "<script src='" . SERVER_ROOT . "scripts/rating.js'></script>" . PHP_EOL;
  }

  private function bodyHeader() {
    echo "<header>".PHP_EOL."<h1>" . ucfirst($this->model->page) . "</h1>".PHP_EOL."</header>" . PHP_EOL;
  }

  private function mainMenu() {
    $this->model->menu->show();
  }

  private function replaceThisMainContentStart() {
    echo "<div class='mainBody'>" . PHP_EOL . PHP_EOL;
  }

  protected function mainContent() {
    echo "<p>mainContent dummy text</p>" . PHP_EOL;
  }

  private function replaceThisMainContentEnd() {
    echo "</div> <!-- mainBody end -->" . PHP_EOL . PHP_EOL;
  }

  private function bodyFooter() {
    echo "<footer>".PHP_EOL."<p>&copy; 2019 Bart Commandeur</p>".PHP_EOL."</footer>" . PHP_EOL;
  }

  protected function underConstruction() {
      echo '
        <h2 style="color:black;font-weight:bold;text-align:center;">Under construction</h2>
        <p>' . LOREM_IPSUM . '</p>
      ';
  }
  
  protected function horizontalLine() {
    echo
      "<hr class='horizontalLine' />" . PHP_EOL;
  }

  // Override function from htmlDoc
  protected function headerContent() {
    $this->title();
    $this->metaAuthor();
    $this->cssLinks();
    $this->javaScript();
  }

  // Override function from htmlDoc
  protected function bodyContent() {
    $this->bodyHeader();
    $this->mainMenu();
    $this->replaceThisMainContentStart();
    $this->mainContent();
    $this->replaceThisMainContentEnd();
    $this->bodyFooter();
  }
}
?>
