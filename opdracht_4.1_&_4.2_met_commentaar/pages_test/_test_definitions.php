<?php
define("PROJECT_ROOT", dirname(__DIR__, 1) ."\\" ); // define root path as the path where index.php is located
define("SERVER_ROOT",
  "http://" .
  $_SERVER['SERVER_NAME'] .
  /* Je vergeet het server port nummer hier */
  "/" .
  explode("/", $_SERVER['REQUEST_URI'])[1] .
  "/" .
  explode("/", $_SERVER['REQUEST_URI'])[2] .
  "/"
);
?>
