<?php
define("LOREM_IPSUM",
  "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
  incididunt ut labore et dolore magna aliqua. Laoreet sit amet cursus sit.
  Vulputate ut pharetra sit amet aliquam id diam maecenas ultricies. Arcu ac
  tortor dignissim convallis aenean et tortor. Rutrum tellus pellentesque eu
  tincidunt tortor. Gravida in fermentum et sollicitudin ac orci phasellus. Nunc
  vel risus commodo viverra." . PHP_EOL);
define("PROJECT_ROOT", __DIR__ . "\\");
define("SERVER_ROOT",
  "http://" .
  $_SERVER['SERVER_NAME'] .
  "/" .
  explode("/", $_SERVER['REQUEST_URI'])[1] .
  "/" .
  explode("/", $_SERVER['REQUEST_URI'])[2] .
  "/"
);
?>
