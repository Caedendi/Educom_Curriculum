<?php
class HtmlDoc {
  private function beginDoc() {
    echo "<!DOCTYPE html>".PHP_EOL."<html>" . PHP_EOL;
  }

  private function beginHeader() {
    echo "<head>" . PHP_EOL;
  }

  protected function headerContent() {
    echo "<title>header dummy text</title>" . PHP_EOL;
  }

  private function endHeader() {
    echo "</head>" . PHP_EOL;
  }

  private function beginBody() {
    echo "<body>" . PHP_EOL;
  }

  protected function bodyContent() {
    echo "<h1>body dummy text</h1>" . PHP_EOL;
  }

  private function endBody() {
    echo "</body>" . PHP_EOL;
  }

  private function endDoc() {
    echo "</html>" . PHP_EOL;
  }

  public function show() {
    $this->beginDoc();
    $this->beginHeader();
    $this->headerContent();
    $this->endHeader();
    $this->beginBody();
    $this->bodyContent();
    $this->endBody();
    $this->endDoc();
  }
}
?>
