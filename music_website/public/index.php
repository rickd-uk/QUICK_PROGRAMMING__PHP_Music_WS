<?php 

session_start();
require '../app/core/init.php';

// Get any query string in URL; default to home if empty
$URL = $_GET['url'] ?? "home";
$URL = trim($URL, '/');
$URL = explode('/', $URL);

$file = page(strtolower($URL[0]));
if (file_exists($file)) {
  require $file;
} else {
   require page('404');
}