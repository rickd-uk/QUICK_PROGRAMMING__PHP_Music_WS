<?php

if ($_SERVER['SERVER_NAME'] == 'localhost')
{
  // for local server
  define('ROOT', 'http://localhost:8888/music_website/public');


  define("DBDRIVER", "mysql");
  define("DBHOST", "localhost");
  define("DBUSER", "root");
  define("DBPW", "root");
  define("DBNAME", "music_website_db");

} else {
  // for webserver
  define('ROOT', 'https://www.myws.com');

  define("DBDRIVER", "mysql");
  define("DBHOST", "localhost");
  define("DBUSER", "root");
  define("DBPW", "");
  define("DBNAME", "music_website_db");


}