<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/css/styles.css" type="text/css">
  <link rel="stylesheet" href="./assets/css/login.css" type="text/css">
  <script src="./assets/js/main.js" defer></script>
  <title>M Site</title>
</head>

<body>

  <header>
    <div class="logo-holder">
      <img class="logo" src="assets/images/logo.jpg" alt="">
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
        <div class="nav-item active"><a href="">Home</a></div>
        <div class="nav-item"><a href="">Music</a></div>
        <div class="nav-item dropdown"><a href="#">Category</a>
          <div class="dropdown-list">
            <div class="nav-item"><a href="">Country</a></div>
            <div class="nav-item"><a href="">Pop</a></div>
            <div class="nav-item"><a href="">R&B</a></div>
          </div>
        </div>
        <div class="nav-item"><a href="">Artists</a></div>
        <div class="nav-item"><a href="">About Us</a></div>
        <div class="nav-item"><a href="">Contact Us</a></div>
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


  <section class="content">
    <div class="login-holder">
      <form method="post">
        <center><img class="logoForLogin" src="assets/images/logo.jpg" alt=""> </center>
        <h2>Login</h2>
        <input class="form-control my-1" type="email" name="email" placeholder="Email">
        <input class="form-control my-1" type="password" name="password" placeholder="Password">
        <button class="btn bg-blue my-1">Login</button>
      </form>
    </div>
  </section>


  <footer>
    <div class="footer-div">
      <ul>
        <li><a href="">Home</a></li>
        <li><a href="">Music</a></li>
        <li><a href="">About Us</a></li>
        <li><a href="">Contact Us</a></li>
        <li><a href="">Login</a></li>
      </ul>
    </div>
    <div class="footer-div">
      <form>
        <div class="form-group">
          <input class="form-control" type="text" placeholder="Search for music" name="find">
          <button class="btn">Search</button>
        </div>
      </form>
    </div>
    <div class="footer-div">
      <div class="follow-links">
        Follow Us:
        <br><br>
        <?php echo file_get_contents("assets/icons/customized/meta.svg"); ?>
        <?php echo file_get_contents("assets/icons/customized/tiktok.svg"); ?>
        <?php echo file_get_contents("assets/icons/customized/instagram.svg"); ?>
      </div>

    </div>
  </footer>
</body>

</html>