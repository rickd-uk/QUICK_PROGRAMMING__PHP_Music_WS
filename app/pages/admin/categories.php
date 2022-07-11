<?php

if ($action == 'add') {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // data validation
    if (empty($_POST['category'])) {
      $errors['category'] = 'a category is required';
    } else if (!preg_match('/^[a-zA-Z \&\-]+$/', $_POST['category'])) {
      $errors['category'] = 'a category can only have letters, &, and spaces';
    }


    if (empty($errors)) {

      $values = [];
      $values['category'] = trim($_POST['category']);
      $values['disabled'] = trim($_POST['disabled']);
    
      $query = 'insert into categories (category,disabled) values (:category,:disabled)';
      db_query($query, $values);

      message('category created successfully');

      redirect('admin/categories');
    }
  }
}
if ($action == 'edit') {
  
 
  $query = 'select * from categories where id = :id limit 1';
  $row = db_query($query, ['id' => $id], 'one');


  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    $errors = [];

    // data validation
    if (empty($_POST['category'])) {
      $errors['category'] = 'a category is required';
    } else if (!preg_match('/^[a-zA-Z \&\-]+$/', $_POST['category'])) {
      $errors['category'] = 'a category can only have letters with spaces';
    }


    if (empty($errors)) {

      $values = [];
      $values['category'] = trim($_POST['category']);
      $values['disabled'] = trim($_POST['disabled']);
      $values['id'] = $id;

      $query = 'update categories set  category = :category, disabled = :disabled where id = :id limit 1';
      if (!empty($_POST['password']))
      {
        $query = 'update categories set  password = :password, category = :category, disabled = :disabled where id = :id limit 1';
      }
      db_query($query, $values);
      message('category edited successfully');
      redirect('admin/categories');
    }
  }
} else

if ($action == 'delete') {
  
 
  $query = 'select * from categories where id = :id limit 1';
  $row = db_query($query, ['id' => $id], 'one');


  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    $errors = [];
    if (empty($errors)) {

      $values = [];
      $values['id'] = $id;

      $query = 'delete from categories where id = :id limit 1';
      db_query($query, $values);

      message('category deleted successfully');
      redirect('admin/categories');
    }
  }
}

?>


<?php require page('includes/admin-header') ?>

<section class="admin-content">

  <?php if ($action == 'add') : ?>
  <section class="mw400">
    <form method="post">
      <h3>Add New Category</h3>
      <input class="form-control my-1" value="<?= set_value('category') ?>" type="text" name="category"
        placeholder="Category">
      <?php if (!empty($errors['category'])) : ?>
      <small class='error'><?= $errors['category'] ?></small>
      <?php endif; ?>


      <select name="disabled" class="form-control my-1">
        <option value="0">--Select Disabled--</option>
        <option <?= set_selected('disabled', '1') ?> value="1">Yes</option>
        <option <?= set_selected('disabled', '0') ?> value="0">No</option>
      </select>

      <?php if (!empty($errors['disabled'])) : ?>
      <small class='error'><?= $errors['disabled'] ?></small>
      <?php endif; ?>

      <a href="<?= ROOT ?>/admin/categories">
        <button class="btn">Back</button>
      </a>
      <button class="btn bg-orange float-end">Save</button>
    </form>
  </section>

  <?php elseif ($action == 'edit') : ?>

  <section class="mw400">
    <form method="post">
      <h3>Edit Category</h3>

      <?php if (!empty($row)) : ?>

      <input class="form-control my-1" value="<?= set_value('category', $row['category']) ?>" type="text"
        name="category" placeholder="Category">
      <?php if (!empty($errors['category'])) : ?>
      <small class='error'><?= $errors['category'] ?></small>
      <?php endif; ?>


      <select name="disabled" class="form-control my-1">
        <option value="">--Select Disabled--</option>
        <option <?= set_selected('disabled', '1',  $row['disabled']) ?> value="1">Yes</option>
        <option <?= set_selected('disabled', '0',  $row['disabled']) ?> value="0">No</option>
      </select>

      <a href="<?= ROOT ?>/admin/categories">
        <button type="button" class="btn">Back</button>
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
      <h3>Delete Category</h3>

      <?php if (!empty($row)) : ?>


      <div class='form-control my-1'><?= set_value('category', $row['category']) ?></div>

      <?php if (!empty($errors['category'])) : ?>
      <small class='error'><?= $errors['category'] ?></small>
      <?php endif; ?>

      <div class='form-control my-1'><?= set_value('email',  $row['email']) ?></div>
      <div class='form-control my-1'><?= set_value('disabled',  $row['disabled']) ?></div>


      <a href="<?= ROOT ?>/admin/categories">
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
    $query = 'select * from categories order by id desc limit 20';
    $rows = db_query($query);
    ?>


  <h4>USERS
    <a href="<?= ROOT ?>/admin/categories/add">
      <button class="float-end btn bg-purple">Add New</button>
    </a>

  </h4>
  <table class=" table">
    <tr>
      <th>ID</th>
      <th>Category</th>
      <th>Active</th>
      <th>Action</th>

    </tr>

    <?php if (!empty($rows)) : ?>
    <?php foreach ($rows as $row) : ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['category'] ?></td>
      <td><?= $row['disabled'] ? 'No' : 'Yes'?></td>

      <td>
        <a href="<?= ROOT ?>/admin/categories/edit/<?= $row['id'] ?>">
          <img class="bi" src="<?= ROOT ?>/assets/icons/pencil-square.svg" alt="">
        </a>
        <a href="<?= ROOT ?>/admin/categories/delete/<?= $row['id'] ?>">
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