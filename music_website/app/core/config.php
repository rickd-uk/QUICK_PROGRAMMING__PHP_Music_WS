<?php

if ($_SERVER['SERVER_NAME'] == 'localhost')
{
  define('ROOT', 'http://localhost:8888/music_website/public');

} else {
  define('ROOT', 'https://www.myws.com');

}