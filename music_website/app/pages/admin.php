<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/css/styles.css" type="text/css">
  <link rel="stylesheet" href="./assets/css/admin.css" type="text/css">
  <script src="./assets/js/main.js" defer></script>
  <title>M Site</title>
</head>

<body>

  <header class="admin-header">
    <div class="logo-holder">
      <img class="logo" src="assets/images/logo.jpg" alt="">
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
        <div class="nav-item active"><a href="">Dashboard</a></div>
        <div class="nav-item"><a href="">Music</a></div>
        <div class="nav-item dropdown"><a href="#">Category</a>

        </div>
        <div class="nav-item"><a href="">Artists</a></div>

        <div class="nav-item dropdown"><a href="#">Hi, user</a>
          <div class="dropdown-list">
            <div class="nav-item"><a href="">Profile</a></div>
            <div class="nav-item"><a href="">Admin</a></div>
            <div class="nav-item"><a href="">Logout</a></div>
          </div>
        </div>
      </div>
    </div>
  </header>


  <section class="admin-content">
    <h4>DASHBOARD</h4>
  </section>


  <footer>
    <center>
      Copyright &copy; 2022
    </center>

  </footer>
</body>

</html>