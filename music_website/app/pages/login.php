<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $values = [];

    $values['email'] = trim($_POST['email']);
    $query = 'select * from users where email = :email limit 1';
    $row = db_query($query, $values, 'one');
  
    if (!empty($row)) {
  
      if (password_verify($_POST['password'], $row['password']))
      {
        authenticate($row);
        message('login successful');
        redirect('admin');
      }
     
    }
    message('wrong email or password');
  }

?>


<?php require page('includes/login-header') ?>


<section class="content">
  <div class="login-holder">

  <?php if (message()) : ?>
     <div class="alert"><?=message('',true)?></div>
  <?php endif; ?>

    <form method="post">
      <center><img class="logoForLogin" src="<?=ROOT?>/assets/images/logo.jpg" alt=""> </center>
      <h2>Login</h2>
      <input class="form-control my-1" value="<?=set_value('email')?>" type="email" name="email" placeholder="Email">
      <input class="form-control my-1" value="<?=set_value('password')?>" type="password" name="password" placeholder="Password">
      <button class="btn bg-blue my-1">Login</button>
    </form>
  </div>
</section>


<?php require page('includes/footer' ) ?>