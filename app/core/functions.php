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

function db_connect() 
{
  // Use PDO to prevent SQL injections
  $string = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
  $con = new PDO($string, DBUSER, DBPW);

  return $con;
}

function db_query($query, $data = array(), $type = 'all') 
{
  // Select * from users where id = :id
  // Connection
  $con = db_connect();

  // $stm = Statement
  $stm = $con->prepare($query);
  // If query could be executed, all is good
  if ($stm)
  {
    $check = $stm->execute($data);
    if ($check){
      // Fetch Associative Array (FETCH_OBJ for Objects)
      // $res = result
      $res = $stm->fetchAll(PDO::FETCH_ASSOC);

      if (is_array($res) && count($res) > 0) {
        if ($type == 'one') return $res[0];
        else return $res;
      }
    }
  }
  return false;
}

function message($message = '', $clear = false)
{
  if (!empty($message)) {
    $_SESSION['message'] = $message;
  } else {
    if (!empty($_SESSION['message'])) {
      $msg = $_SESSION['message'];
      if ($clear) unset($_SESSION['message']);
      return $msg;
    }
  }
  return false;
}

function redirect($page) 
{
   header('Location: '.ROOT.'/'.$page);
   die;
}

function validate()
{

}

function set_value($key, $default = '') 
{
  if (!empty($_POST[$key]))
  {
    return $_POST[$key];
  } else {
    return $default;
  }

  return '';
}

function set_selected($key, $value, $default = '') 

{
   if (!empty($_POST[$key])) 
   {
      if ($_POST[$key] == $value)
      {
        return 'selected';
      }
   } else {
    if ($default == $value)
    {
      return 'selected';
    }
   }
}

function get_date($date) 
{
  // strtotime - converts to an integer
  return date('jS M, Y', strtotime($date));
}

function is_logged_in() 
{ 
   if (!empty($_SESSION['USER']) && is_array($_SESSION['USER']))
   {
    return true;
   }
   return false;
}

function is_admin() 
{ 
   if (!empty($_SESSION['USER']['role']) && $_SESSION['USER']['role'] == 'admin')
   {
    return true;
   }
   return false;
}

function user($col)
{
  if (!empty($_SESSION['USER'][$col])) 
  {
    return $_SESSION['USER'][$col];
  }

  return 'unknown';
}

function authenticate($row)
{
 $_SESSION['USER'] = $row;
}