<?php
class Product {
  public $id;
  public $name;
  public $price;
  public $image;
  public $summary;
  public $description;
  public $rating;

  public function __construct(
    int $id,
    string $name,
    float $price,
    string $image,
    string $summary,
    string $description,
    float $rating)
  {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->image = $image;
    $this->summary = $summary;
    $this->description = $description;
    $this->rating = $rating;
  }
}
?>
