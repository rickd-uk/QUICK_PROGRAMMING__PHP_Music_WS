<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>M Site</title>
</head>

<body>

  <style>
  @font-face {
    src: url('assets/fonts/Lato/Lato-Regular.ttf');
    font-family: lato;
  }

  * {
    box-sizing: border-box;
  }

  body {
    min-width: 350px;
    font-family: lato, sans-serif, tahoma;
    margin: 0px;
    padding: 0px;

  }

  body img {
    width: 100%;
  }

  body a {
    text-decoration: none;
  }

  header {
    display: flex;
  }

  .logo-holder {
    max-width: 100px;
    flex: 1;
  }

  .header-div {
    flex: auto;
  }

  .main-nav {
    display: flex;
  }

  .nav-item {
    padding: 10px;
    text-align: center;
  }

  .main-title {
    padding: 10px;
  }

  header .active {
    border-bottom: solid 4px red;
  }

  .dropdown {
    position: relative;
  }

  .dropdown-list {
    position: absolute;
    border: solid thin #ccc;
    background-color: white;
    margin-top: 10px;
  }
  </style>

  <header>
    <div class='logo-holder'>
      <img class='logo' src="assets/images/logo.jpg" alt="">
    </div>
    <div class='header-div'>
      <div class='main-title'>MUSIC WEBSITE</div>
      <div class='main-nav'>
        <div class="nav-item active"><a href="">Home</a></div>
        <div class="nav-item"><a href="">Music</a></div>
        <div class="nav-item dropdown"><a href="">Category</a>
          <div class='dropdown-list'>
            <div class="nav-item"><a href="">Country</a></div>
            <div class="nav-item"><a href="">Pop</a></div>
            <div class="nav-item"><a href="">R&B</a></div>
          </div>
        </div>
        <div class="nav-item"><a href="">Artists</a></div>
        <div class="nav-item"><a href="">About Us</a></div>
        <div class="nav-item"><a href="">Contact Us</a></div>
        <div class="nav-item dropdown"><a href="">Hi, user</a>
          <div class='dropdown-list'>
            <div class="nav-item"><a href="">Profile</a></div>
            <div class="nav-item"><a href="">Admin</a></div>
            <div class="nav-item"><a href="">Logout</a></div>
          </div>
        </div>
      </div>
    </div>
  </header>
</body>

</html>