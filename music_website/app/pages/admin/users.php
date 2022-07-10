<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $errors = [];
  // data validation
  if (empty($_POST['username'])) {
    $errors['username'] = 'a username is required';
  } else if (preg_match('/^[a-zA-Z]+$/', $_POST['username'])) {
    $errors['username'] = 'a username can only have letters with spaces';
  }


  if (empty($_POST['email'])) {
    $errors['email'] = 'a email is required';
  } else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'a email not valid';
  }


  if (empty($_POST['password'])) {
    $errors['password'] = 'a password is required';
  } else if ($_POST['password'] != $_POST['retyped_password']) {
    $errors['password'] = 'passwords do not match';
  }

  if (empty($_POST['role'])) {
    $errors['role'] = 'a role is required';
  }

  if (empty($errors)) {
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
        <input class="form-control my-1" value="" type="text" name="username" placeholder="Username">
        <?php if (!empty($errors['username'])) : ?>
          <small class='error'><?=$errors['username']?></small>
        <?php endif; ?>
        <input class="form-control my-1" value="" type="email" name="email" placeholder="Email">
        <?php if (!empty($errors['email'])) : ?>
          <small class='error'><?=$errors['email']?></small>
        <?php endif; ?>
        <select name="role" class="form-control my-1">
          <option value="">--Select Role--</option>
          <option value=" user">User</option>
          <option value="admin">Admin</option>
        </select>
        <?php if (!empty($errors['role'])) : ?>
          <small class='error'><?=$errors['role']?></small>
        <?php endif; ?>
        <input class="form-control my-1" value="" type="password" name="password" placeholder="Password">
        <?php if (!empty($errors['password'])) : ?>
          <small class='error'><?=$errors['password']?></small>
        <?php endif; ?>
        <input class="form-control my-1" value="" type="password" name="retyped_password" placeholder="Retype Password">

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
      <tr>
        <td>ID</td>
        <td>Username</td>
        <td>Email</td>
        <td>Role</td>
        <td>Date</td>
        <td>Action</td>
      </tr>
    </table>
  <?php endif; ?>


</section>

<?php require page('includes/admin-footer') ?>