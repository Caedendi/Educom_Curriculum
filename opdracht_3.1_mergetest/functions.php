<?php
function getPostValue($key, $default='') {
  $value = filter_input(INPUT_POST, $key);
  return isset($value) ? $value : $default;
}

function getUrlValue($key, $default='') {
  $value = filter_input(INPUT_GET, $key);
  return isset($value) ? $value : $default;
}

function getArrayValue($array, $key, $default='') {
  return isset($array[$key]) ? $array[$key] : $default;
}

// tests form input data for security purposes
function testInput($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}

//implement mysqli_real_escape_string() in post values

?>
