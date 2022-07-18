<?php

session_start();
require '../app/core/init.php';

// Get any query string in URL; default to home if empty
$URL = $_GET['url'] ?? "home";
$URL = trim($URL, '/');
$URL = explode('/', $URL);

// get page no.
$page = $_GET['page'] ?? 1;
$page = (int)$page;

$prev_page = $page <= 1 ? 1 : $page - 1;
$next_page = $page + 1;


$file = page(strtolower($URL[0]));
if (file_exists($file)) {
  require $file;
} else {
  require page('404');
}
