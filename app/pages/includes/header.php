<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/styles.css?2dsdghs3" type="text/css">
  <script src="<?= ROOT ?>/assets/js/main.js?4" defer></script>
  <title><?= ucfirst($URL[0]) ?></title>
</head>

<body>

  <header>
    <div class="logo-holder">
      <img class="logo" src="<?= ROOT ?>/assets/images/logo.jpg" alt="">
    </div>
    <div class="header-div">
      <div class="main-title">
        <h2>MUSIC WEBSITE</h2>
        <div class="socials">
          <?php echo file_get_contents("assets/icons/customized/meta-top.svg"); ?>
          <?php echo file_get_contents("assets/icons/customized/tiktok-top.svg"); ?>
          <?php echo file_get_contents("assets/icons/customized/instagram-top.svg"); ?>
        </div>
      </div>
      <div class="main-nav">
        <div class="nav-item"><a href="<?= ROOT ?>">Home</a></div>
        <div class="nav-item"><a href="<?= ROOT ?>/music">Music</a></div>
        <div class="nav-item dropdown"><a href="#">Category</a>
          <?php
          $query = 'select * from categories order by category asc';
          $categories = db_query($query);
          ?>

          <div class="dropdown-list">
            <?php if (!empty($categories)) : ?>
              <?php foreach ($categories as $cat) : ?>
                <div class="nav-item"><a href="<?= ROOT ?>/category/<?= $cat['category'] ?>"><?= $cat['category'] ?></a></div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
        <div class="nav-item"><a href="<?= ROOT ?>/artists">Artists</a></div>
        <div class="nav-item"><a href="<?= ROOT ?>/about">About Us</a></div>
        <div class="nav-item"><a href="<?= ROOT ?>/contact">Contact Us</a></div>

        <?php if (is_logged_in()) : ?>
          <div class="nav-item dropdown"><a href="#">Hi, <?= user('username') ?></a>
            <div class="dropdown-list">
              <div class="nav-item"><a href="<?= ROOT ?>/admin/users/edit/<?= user('id') ?>">Profile</a></div>
              <div class="nav-item"><a href="<?= ROOT ?>/admin">Admin</a></div>
              <div class="nav-item"><a href="<?= ROOT ?>/logout">Logout</a></div>
            </div>
          </div>
        <?php endif ?>


      </div>
    </div>
  </header>