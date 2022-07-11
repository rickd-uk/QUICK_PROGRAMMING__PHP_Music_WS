<?php

if ($action == 'add') {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $errors = [];

    // data validation
    if (empty($_POST['username'])) {
      $errors['username'] = 'a username is required';
    } else if (!preg_match('/^[a-zA-Z]+$/', $_POST['username'])) {
      $errors['username'] = 'a username can only have letters with spaces';
    }


    if (empty($_POST['email'])) {
      $errors['email'] = 'a email is required';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'a email not valid';
    }


    if (empty($_POST['password'])) {
      $errors['password'] = 'a password is required';
    } else if ($_POST['password'] != $_POST['retyped_password']) {
      $errors['password'] = 'passwords do not match';
    } else if (strlen($_POST['password']) < 8) {
      $errors['password'] = 'passwords must be 8 characters or more';
    }

    if (empty($_POST['role'])) {
      $errors['role'] = 'a role is required';
    }
    json_encode($errors);

    if (empty($errors)) {

      $values = [];
      $values['username'] = trim($_POST['username']);
      $values['email'] = trim($_POST['email']);
      $values['role'] = trim($_POST['role']);
      $values['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $values['date'] = date('Y-m-d H:i:s');

      $query = 'insert into users (username,email,password,role,date) values (:username,:email,:password,:role,:date)';
      db_query($query, $values);

      message('user created successfully');

      redirect('admin/users');
    }
  }
}
if ($action == 'edit') {
  
 
  $query = 'select * from users where id = :id limit 1';
  $row = db_query($query, ['id' => $id], 'one');


  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    $errors = [];

    // data validation
    if (empty($_POST['username'])) {
      $errors['username'] = 'a username is required';
    } else if (!preg_match('/^[a-zA-Z]+$/', $_POST['username'])) {
      $errors['username'] = 'a username can only have letters with spaces';
    }


    if (empty($_POST['email'])) {
      $errors['email'] = 'a email is required';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'a email not valid';
    }


    if (!empty($_POST['password'])) {
      if ($_POST['password'] != $_POST['retyped_password']) {
        $errors['password'] = 'passwords do not match';
      } else if (strlen($_POST['password']) < 8) {
        $errors['password'] = 'passwords must be 8 characters or more';
      }
    }

    if (empty($_POST['role'])) {
      $errors['role'] = 'a role is required';
    }
    json_encode($errors);

    if (empty($errors)) {

      $values = [];
      $values['username'] = trim($_POST['username']);
      $values['email'] = trim($_POST['email']);
      $values['role'] = trim($_POST['role']);
      $values['id'] = $id;

      $query = 'update users set email = :email, username = :username, role = :role where id = :id limit 1';
      if (!empty($_POST['password']))
      {
        $query = 'update users set email = :email, password = :password, username = :username, role = :role where id = :id limit 1';
        $values['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
      }
      db_query($query, $values);

      message('user edited successfully');

      redirect('admin/users');
    }
  }
} else

if ($action == 'delete') {
  
 
  $query = 'select * from users where id = :id limit 1';
  $row = db_query($query, ['id' => $id], 'one');


  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    $errors = [];

    if ($row['id'] == 1)
    {
      $errors['username'] = 'the main admin cannot be deleted';
    }

    if (empty($errors)) {

      $values = [];
      $values['id'] = $id;

      $query = 'delete from users where id = :id limit 1';
      db_query($query, $values);

      message('user deleted successfully');
      redirect('admin/users');
    }
  }
}

?>


<?php require page('includes/admin-header') ?>

<section class="admin-content">

  <?php if ($action == 'add') : ?>
  <section class="mw400">
    <form method="post">
      <h3>Add New User</h3>
      <input class="form-control my-1" value="<?= set_value('username') ?>" type="text" name="username"
        placeholder="Username">
      <?php if (!empty($errors['username'])) : ?>
      <small class='error'><?= $errors['username'] ?></small>
      <?php endif; ?>
      <input class="form-control my-1" value="<?= set_value('email') ?>" type="email" name="email" placeholder="Email">
      <?php if (!empty($errors['email'])) : ?>
      <small class='error'><?= $errors['email'] ?></small>
      <?php endif; ?>
      <select name="role" class="form-control my-1">
        <option value="">--Select Role--</option>
        <option <?= set_selected('role', 'user') ?> value="user">User</option>
        <option <?= set_selected('role', 'admin') ?> value="admin">Admin</option>
      </select>

      <?php if (!empty($errors['role'])) : ?>
      <small class='error'><?= $errors['role'] ?></small>
      <?php endif; ?>

      <input class="form-control my-1" value="<?= set_value('password') ?>" type="password" name="password"
        placeholder="Password">
      <?php if (!empty($errors['password'])) : ?>
      <small class='error'><?= $errors['password'] ?></small>
      <?php endif; ?>

      <input class="form-control my-1" value="<?= set_value('retyped_password') ?>" type="password"
        name="retyped_password" placeholder="Retype Password">

      <a href="<?= ROOT ?>/admin/users">
        <button class="btn">Back</button>
      </a>
      <button class="btn bg-orange float-end">Save</button>
    </form>
  </section>

  <?php elseif ($action == 'edit') : ?>

  <section class="mw400">
    <form method="post">
      <h3>Edit User</h3>

      <?php if (!empty($row)) : ?>

      <input class="form-control my-1" value="<?= set_value('username', $row['username']) ?>" type="text"
        name="username" placeholder="Username">
      <?php if (!empty($errors['username'])) : ?>
      <small class='error'><?= $errors['username'] ?></small>
      <?php endif; ?>
      <input class="form-control my-1" value="<?= set_value('email',  $row['email']) ?>" type="email" name="email"
        placeholder="Email">
      <?php if (!empty($errors['email'])) : ?>
      <small class='error'><?= $errors['email'] ?></small>
      <?php endif; ?>
      <select name="role" class="form-control my-1">
        <option value="">--Select Role--</option>
        <option <?= set_selected('role', 'user',  $row['role']) ?> value="user">User</option>
        <option <?= set_selected('role', 'admin',  $row['role']) ?> value="admin">Admin</option>
      </select>

      <?php if (!empty($errors['role'])) : ?>
      <small class='error'><?= $errors['role'] ?></small>
      <?php endif; ?>


      <!-- stop chrome autocompleting a password -->
      <input style="display:none">
      <input type="password" style="display:none">


      <input class="form-control my-1" autocomplete="" value="<?= set_value('password') ?>" type="password"
        name="password" placeholder="Password (leave empty to keep old one)">
      <?php if (!empty($errors['password'])) : ?>
      <small class='error'><?= $errors['password'] ?></small>
      <?php endif; ?>

      <input class="form-control my-1" value="<?= set_value('retyped_password') ?>" type="password"
        name="retyped_password" placeholder="Retype Password">

      <a href="<?= ROOT ?>/admin/users">
        <button class="btn">Back</button>
      </a>
      <button class="btn bg-orange float-end">Save</button>

      <?php else : ?>
      <div class="alert">Record was not found</div>
      <?php endif; ?>
    </form>
  </section>
  <?php elseif ($action == 'delete') : ?>
  <section class="mw400">
    <form method="post">
      <h3>Delete User</h3>

      <?php if (!empty($row)) : ?>


      <div class='form-control my-1'><?= set_value('username', $row['username']) ?></div>

      <?php if (!empty($errors['username'])) : ?>
      <small class='error'><?= $errors['username'] ?></small>
      <?php endif; ?>

      <div class='form-control my-1'><?= set_value('email',  $row['email']) ?></div>
      <div class='form-control my-1'><?= set_value('role',  $row['role']) ?></div>

      <a href="<?= ROOT ?>/admin/users">
        <button type="button" class="btn">Back</button>
      </a>

      <button class="btn bg-orange float-end">Delete</button>


      <?php else : ?>
      <div class="alert">Record was not found</div>
      <?php endif; ?>
    </form>
  </section>
  <?php else : ?>

  <?php
    $query = 'select * from users order by id desc limit 20';
    $rows = db_query($query);
    ?>


  <h4>USERS
    <a href="<?= ROOT ?>/admin/users/add">
      <button class="float-end btn bg-purple">Add New</button>
    </a>

  </h4>
  <table class=" table">
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Role</th>
      <th>Date</th>
      <th>Action</th>
    </tr>

    <?php if (!empty($rows)) : ?>
    <?php foreach ($rows as $row) : ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['username'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><?= $row['role'] ?></td>
      <td><?= get_date($row['date']) ?></td>
      <td>
        <a href="<?= ROOT ?>/admin/users/edit/<?= $row['id'] ?>">
          <img class="bi" src="<?= ROOT ?>/assets/icons/pencil-square.svg" alt="">
        </a>
        <a href="<?= ROOT ?>/admin/users/delete/<?= $row['id'] ?>">
          <img class="bi" src="<?= ROOT ?>/assets/icons/trash3.svg" alt="">
        </a>

      </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>

  </table>
  <?php endif; ?>


</section>

<?php require page('includes/admin-footer') ?>