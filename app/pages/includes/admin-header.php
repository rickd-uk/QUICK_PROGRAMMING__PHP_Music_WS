<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/styles.css?q78wewrre" type="text/css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin.css?4wewe2" type="text/css">
  <script src="<?= ROOT ?>/assets/js/main.js" defer></script>
  <title>M Site</title>
</head>

<body>

  <header class="admin-header">
    <div class="logo-holder">
      <a href="<?= ROOT ?>">
        <img class="logo" src="<?= ROOT ?>/assets/images/logo.jpg" alt="">
      </a>

    </div>
    <div class="header-div">
      <div class="main-title">
        <h2>ADMIN</h2>
        <div class="socials">
          <?php echo file_get_contents("assets/icons/customized/meta-top.svg"); ?>
          <?php echo file_get_contents("assets/icons/customized/tiktok-top.svg"); ?>
          <?php echo file_get_contents("assets/icons/customized/instagram-top.svg"); ?>
        </div>
      </div>
      <div class="main-nav">
        <div class="nav-item"><a href="<?= ROOT ?>/admin">Dashboard</a></div>
        <div class="nav-item"><a href="<?= ROOT ?>/admin/users">Users</a></div>
        <div class="nav-item"><a href="<?= ROOT ?>/admin/songs">Songs</a></div>
        <div class="nav-item dropdown"><a href="<?= ROOT ?>/admin/categories">Categories</a>

        </div>
        <div class="nav-item"><a href="<?= ROOT ?>/admin/artists">Artists</a></div>

        <div class="nav-item dropdown"><a href="#">Hi, <?=user('username')?></a>
          <div class="dropdown-list">
            <div class="nav-item"><a href="<?= ROOT ?>/profile">Profile</a></div>
            <div class="nav-item"><a href="<?= ROOT ?>">Website</a></div>
            <div class="nav-item"><a href="<?= ROOT ?>/logout">Logout</a></div>
          </div>
        </div>
      </div>
    </div>
  </header>


  <?php if (message()) : ?>
  <div class="alert"><?=message('',true)?></div>
  <?php endif; ?>