<?php require page('includes/login-header') ?>


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


<?php require page('includes/footer' ) ?>