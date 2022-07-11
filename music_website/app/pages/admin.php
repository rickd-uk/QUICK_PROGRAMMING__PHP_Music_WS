<?php

if (!is_admin()) {
  message('only admins can access the admin page');
  redirect('login');
} 

//  e.g.    /admin/users/edit/200
//                   1    2   3
$section  = $URL[1] ?? "dashboard";
$action   = $URL[2] ?? null;
$id       = $URL[3] ?? null;

switch ($section) {
  case 'dashboard':
    require page('admin/dashboard');
    break;
    
  case 'users':
    require page('admin/users');
    break;

  default:
    require page('admin/404');
    break;
}