<?php

if ($action == 'add') {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // data validation
    if (empty($_POST['name'])) {
      $errors['name'] = 'a name is required';
    } else if (!preg_match('/^[a-zA-Z \&\-]+$/', $_POST['name'])) {
      $errors['name'] = 'a name can only have letters, &, and spaces';
    }

    // image validation
    if (!empty($_FILES['image']['name']) && empty($errors)) {
      $folder = 'uploads/';

      // if uploads dir doesn't exist make it & add index.php for security
      if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
        file_put_contents($folder . 'index.php', '');
      }

      // allow only specified image file types
      $allowed = ['image/jpeg', 'image/png'];

      // check there are no errors, and specified image files have been chosen
      if ($_FILES['image']['error'] == 0 &&  in_array($_FILES['image']['type'], $allowed)) {
        // set destination dir
        $destination = $folder . $_FILES['image']['name'];

        // move temp file to destination
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
      } else {
        // alert user that image format is not valid, and show allowed types
        $errors['name'] = 'Image not valid. Allowed types are ' . implode(',', $allowed);
      }
    } else {
      $errors['image'] = 'Image is required';
    }


    if (empty($errors)) {

      $values = [];
      $values['name'] = trim($_POST['name']);
      $values['bio'] = trim($_POST['bio']);
      $values['image'] = $destination;
      $values['user_id'] = user('id');

      $query = 'insert into artists (name, bio, user_id, image) values (:name,:bio,:user_id,:image)';
      db_query($query, $values);

      message('Artist created successfully');

      redirect('admin/artists');
    }
  }
}
if ($action == 'edit') {


  $query = 'select * from artists where id = :id limit 1';
  $row = db_query($query, ['id' => $id], 'one');


  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    $errors = [];

    // data validation
    if (empty($_POST['name'])) {
      $errors['name'] = 'a name is required';
    } else if (!preg_match('/^[a-zA-Z \&\-]+$/', $_POST['name'])) {
      $errors['name'] = 'a name can only have letters with spaces';
    }

    //image
    if (!empty($_FILES['image']['name'])) {

      $folder = "uploads/";
      if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
        file_put_contents($folder . "index.php", "");
      }

      $allowed = ['image/jpeg', 'image/png'];
      if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {

        $destination = $folder . $_FILES['image']['name'];

        move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        //delete old file
        if (file_exists($row['image'])) {
          unlink($row['image']);
        }
      } else {
        $errors['name'] = "image no valid. allowed types are " . implode(",", $allowed);
      }
    }



    if (empty($errors)) {

      $values = [];
      $values['name'] = trim($_POST['name']);
      $values['bio'] = trim($_POST['bio']);
      $values['user_id'] = user('id');
      $values['id'] = $id;

      $query = 'update artists set  name = :name, bio = :bio, user_id = :user_id where id = :id limit 1';
      if (!empty($destination)) {

        $values['image'] = $destination;
        $query = 'update artists set  name = :name, bio = :bio, user_id = :user_id, image = :image where id = :id limit 1';
      }
      db_query($query, $values);
      message('Artist edited successfully');
      redirect('admin/artists');
    }
  }
} else

if ($action == 'delete') {


  $query = 'select * from artists where id = :id limit 1';
  $row = db_query($query, ['id' => $id], 'one');


  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    $errors = [];
    if (empty($errors)) {

      

      $values = [];
      $values['id'] = $id;

      $query = 'delete from artists where id = :id limit 1';
      db_query($query, $values);

      //delete old file
      if (file_exists($row['image'])) {
        unlink($row['image']);
      }

      message('Artist deleted successfully');
      redirect('admin/artists');
    }
  }
}

?>


<?php require page('includes/admin-header') ?>
<section class="admin-content">

  <?php if ($action == 'add') : ?>
  <section class="mw400">
    <form method="post" enctype="multipart/form-data">
      <h3>Add New Artist</h3>
      <input class="form-control my-1" value="<?= set_value('name') ?>" type="text" name="name" placeholder="Name">
      <?php if (!empty($errors['name'])) : ?>
      <small class='error'><?= $errors['name'] ?></small>
      <br> <br>
      <?php endif; ?>

      <label>Image</label>
      <input class="form-control my-1" type="file" name="image">

      <label>Bio:</label>
      <textarea name="bio" class="form-control" cols="30" rows="10"><?= set_value('bio') ?></textarea>

      <?php if (!empty($errors['image'])) : ?>
      <small class='error'><?= $errors['image'] ?></small>
      <br> <br>
      <?php endif; ?>

      <a href="<?= ROOT ?>/admin/artists">
        <button class="btn bg-back">Back</button>
      </a>
      <button class="btn bg-warning float-end">Save</button>
    </form>
  </section>

  <?php elseif ($action == 'edit') : ?>

  <section class="mw400">
    <form method="post" enctype="multipart/form-data">
      <h3>Edit Artist</h3>

      <?php if (!empty($row)) : ?>

      <input class="form-control my-1" value="<?= set_value('name', $row['name']) ?>" type="text" name="name"
        placeholder="name">
      <?php if (!empty($errors['name'])) : ?>
      <small class='error'><?= $errors['name'] ?></small>
      <?php endif; ?>

      <img class='artist_img' src="<?= ROOT ?>/<?= $row['image'] ?>" alt="">
      <input class="form-control my-1" type="file" name="image">

      <label>Bio:</label>
      <textarea name="bio" class="form-control" cols="30" rows="10"><?= set_value('bio') ?></textarea>

      <a href="<?= ROOT ?>/admin/artists">
        <button type="button" class="btn bg-back">Back</button>
      </a>
      <button class="btn bg-warning float-end">Save</button>

      <?php else : ?>
      <div class="alert">Record was not found</div>
      <?php endif; ?>
    </form>
  </section>
  <?php elseif ($action == 'delete') : ?>
  <section class="mw400">
    <form method="post">
      <h3>Delete Artist</h3>

      <?php if (!empty($row)) : ?>


      <div class='form-control my-1'><?= set_value('name', $row['name']) ?></div>

      <?php if (!empty($errors['name'])) : ?>
      <small class='error'><?= $errors['name'] ?></small>
      <?php endif; ?>


      <a href="<?= ROOT ?>/admin/artists">
        <button type="button" class="btn bg-back">Back</button>
      </a>

      <button class="btn bg-warning float-end">Delete</button>


      <?php else : ?>
      <div class="alert">Record was not found</div>
      <?php endif; ?>
    </form>
  </section>
  <?php else : ?>

  <?php
    $query = 'select * from artists order by id desc limit 20';
    $rows = db_query($query);
    ?>

  <a href="<?= ROOT ?>/admin/artists/add">
    <button class="float-end btn bg-purple mb-3">Add New</button>
  </a>


  <table class=" table">
    <tr>
      <th>ID</th>
      <th>Image</th>
      <th>Artist</th>
      <th>Action</th>

    </tr>

    <?php if (!empty($rows)) : ?>
    <?php foreach ($rows as $row) : ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><img class='artist_img' src="<?= ROOT ?>/<?= $row['image'] ?>" alt=""></td>


      <td>
        <a href="<?= ROOT ?>/admin/artists/edit/<?= $row['id'] ?>">
          <img class="bi" src="<?= ROOT ?>/assets/icons/pencil-square.svg" alt="">
        </a>
        <a href="<?= ROOT ?>/admin/artists/delete/<?= $row['id'] ?>">
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