<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/css/styles.css" type="text/css">
  <script src="./assets/scripts/js.js" defer></script>
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

  <section>
    <img class="hero" src="assets/images/hero.jpeg" alt="">
  </section>

  <div class="section-title">Featured</div>
  <section class="content">


    <!-- Music card -->
    <div class="music-card">
      <div style="overflow: hidden;">
        <a href=""> <img src="assets/images/01.jpg" alt=""> </a>
      </div>
      <div class="card-content">
        <div class="card-title">Song Title</div>
        <div class="card-subtitle">Artist's Name</div>
      </div>
    </div>
    <!-- End Music card -->

    <!-- Music card -->
    <div class="music-card">
      <div style="overflow: hidden;">
        <a href=""><img src="assets/images/01.jpg" alt="">
        </a>
      </div>
      <div class="card-content">
        <div class="card-title">Song Title</div>
        <div class="card-subtitle">Artist's Name</div>
      </div>
    </div>
    <!-- End Music card -->

    <!-- Music card -->
    <div class="music-card">
      <div style="overflow: hidden;">
        <a href=""> <img src="assets/images/01.jpg" alt=""> </a>
      </div>
      <div class="card-content">
        <div class="card-title">Song Title</div>
        <div class="card-subtitle">Artist's Name</div>
      </div>
    </div>
    <!-- End Music card -->

    <!-- Music card -->
    <div class="music-card">
      <div style="overflow: hidden;">
        <a href=""> <img src="assets/images/01.jpg" alt=""> </a>
      </div>
      <div class="card-content">
        <div class="card-title">Song Title</div>
        <div class="card-subtitle">Artist's Name</div>
      </div>
    </div>
    <!-- End Music card -->

    <!-- Music card -->
    <div class="music-card">
      <div style="overflow: hidden;">
        <a href=""> <img src="assets/images/01.jpg" alt=""> </a>
      </div>
      <div class="card-content">
        <div class="card-title">Song Title</div>
        <div class="card-subtitle">Artist's Name</div>
      </div>
    </div>
    <!-- End Music card -->
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