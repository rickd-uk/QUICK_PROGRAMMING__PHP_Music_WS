<?php

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
?>


<?php require page('includes/admin-header') ?>

<section class="admin-content">

  <?php if ($action == 'add') : ?>
    <section class="mw400">
      <form method="post">
        <h3>Add New User</h3>
        <input class="form-control my-1" value="<?= set_value('username') ?>" type="text" name="username" placeholder="Username">
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

        <input class="form-control my-1" value="<?= set_value('password') ?>" type="password" name="password" placeholder="Password">
        <?php if (!empty($errors['password'])) : ?>
          <small class='error'><?= $errors['password'] ?></small>
        <?php endif; ?>

        <input class="form-control my-1" value="<?= set_value('retyped_password') ?>" type="password" name="retyped_password" placeholder="Retype Password">

        <a href="<?= ROOT ?>/admin/users">
          <button class="btn">Back</button>
        </a>
        <button class="btn bg-orange float-end">Save</button>
      </form>
    </section>

  <?php elseif ($action == 'edit') : ?>
    edit
  <?php elseif ($action == 'delete') : ?>
    delete
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