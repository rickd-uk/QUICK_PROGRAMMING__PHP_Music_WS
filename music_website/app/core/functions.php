<?php

function show($stuff) 
{
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
}

function page($file) 
{
  return '../app/pages/' .$file.'.php';
}