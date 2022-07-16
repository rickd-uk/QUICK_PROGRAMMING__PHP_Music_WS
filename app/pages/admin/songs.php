<?php



if ($action == 'add') {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    
    // data validation
    if (empty($_POST['title'])) {
      $errors['title'] = 'a title is required';
    } else if (!preg_match('/^[a-zA-Z0-9 \.\!\?\&\-]+$/', $_POST['title'])) {
      $errors['title'] = 'a title can only have letters, &, and spaces';
    }

    if (empty($_POST['category_id'])) 
    {
       $errors['category_id'] = 'a category is required';
    }
    if (empty($_POST['artist_id'])) 
    {
       $errors['artist_id'] = 'an artist is required';
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
        $destination_image = $folder . $_FILES['image']['name'];

        // move temp file to destination
        move_uploaded_file($_FILES['image']['tmp_name'], $destination_image);
      } else {
        // alert user that image format is not valid, and show allowed types
        $errors['title'] = 'Image not valid. Allowed types are ' . implode(',', $allowed);
      }
    } else {
      $errors['image'] = 'Image is required';
    }

  
    	//audio file
			if(!empty($_FILES['audio']['name']))
			{

				$folder = "uploads/";
				if(!file_exists($folder))
				{
					mkdir($folder,0777,true);
					file_put_contents($folder."index.php", "");
				}

				$allowed = ['audio/mpeg', 'audio/wav'];
				if($_FILES['audio']['error'] == 0 && in_array($_FILES['audio']['type'], $allowed))
				{
					
					$destination_audio = $folder. $_FILES['audio']['name'];

					move_uploaded_file($_FILES['audio']['tmp_name'], $destination_audio);

				}else{
					$errors['audio'] = "file not valid. allowed types are ". implode(",", $allowed);
				}
				

			}else{
				$errors['audio'] = "an audio file is required";
			}


    if (empty($errors)) {

      $values = [];
      $values['title'] = trim($_POST['title']);
      $values['category_id'] = trim($_POST['category_id']);
      $values['artist_id'] = trim($_POST['artist_id']);
      $values['image'] = $destination_image;
      $values['audio'] = $destination_audio;
      $values['user_id'] = user('id');
      $values['date'] = date('Y-m-d H:i:s');
      $values['views'] = 0;
      $values['slug'] = str_to_url($values['title']);

      $query = 'insert into songs (title, user_id, image, audio, category_id, artist_id, date, views, slug) values (:title,:user_id,:image, :audio, :category_id, :artist_id, :date, :views, :slug)';
      db_query($query, $values);

      message('Song created successfully');
      redirect('admin/songs');
    }
  }
}
if ($action == 'edit') {

  $query = 'select * from songs where id = :id limit 1';
  $row = db_query($query, ['id' => $id], 'one');

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    $errors = [];

    // data validation
    if (empty($_POST['title'])) {
      $errors['title'] = 'a title is required';
    } else if (!preg_match('/^[a-zA-Z0-9 \.\!\?\&\-]+$/', $_POST['title'])) {
      $errors['title'] = 'a title can only have letters with spaces';
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

        $destination_image = $folder . $_FILES['image']['name'];

        show($destination_image);
       

        move_uploaded_file($_FILES['image']['tmp_name'], $destination_image);

        //delete old file
        if (file_exists($row['image'])) {
          unlink($row['image']);
        }
      } else {
        $errors['image'] = "image not valid. allowed types are " . implode(",", $allowed);
      }
    }





    if (empty($errors)) {

      $values = [];
      $values['title'] = trim($_POST['title']);
      $values['category_id'] = trim($_POST['category_id']);
      $values['artist_id'] = trim($_POST['artist_id']);
      $values['user_id'] = user('id');
      $values['id'] = $id;

      $query = 'update songs set  title = :title, user_id = :user_id, category_id = :category_id, artist_id = :artist_id ';
      

      if (!empty($destination_image)) {

        $query .= ', image = :image';
        $values['image'] = $destination_image;
      }
      if (!empty($destination_audio)) {

        $query .= ', audio = :audio';
        $values['audio'] = $destination_audio;
      }

      $query .= ' where id = :id limit 1';

      db_query($query, $values);
      message('Song edited successfully');
      redirect('admin/songs');
    }
  }
} else

if ($action == 'delete') {


  $query = 'select * from songs where id = :id limit 1';
  $row = db_query($query, ['id' => $id], 'one');


  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    $errors = [];
    if (empty($errors)) {

      $values = [];
      $values['id'] = $id;

      $query = 'delete from songs where id = :id limit 1';
      db_query($query, $values);

      // delete old audio
      if (file_exists($row['audio']))
      {
        unlink($row['audio']);
      }

      //delete old image
      if (file_exists($row['image'])) {
        unlink($row['image']);
      }

      message('Song deleted successfully');
      redirect('admin/songs');
    }
  }
}
?>

<?php require page('includes/admin-header') ?>
<section class="admin-content">

  <?php if ($action == 'add') : ?>
  <section class="mw400">
    <form method="post" enctype="multipart/form-data">
      <h3>Add New Song</h3>
      <input class="form-control my-1" value="<?= set_value('title') ?>" type="text" name="title"
        placeholder="Song title">
      <?php if (!empty($errors['title'])) : ?>
      <small class='error'><?= $errors['title'] ?></small>
      <?php endif; ?>

      <?php
        $query = 'select * from categories order by category asc';
        $categories = db_query($query);
        ?>

      <select name="category_id" class="form-control my-1">
        <option value="">--Select Category--</option>

        <?php if (!empty($categories)) : ?>
        <?php foreach ($categories as $cat) : ?>
        <option <?= set_selected('category_id', $cat['id']) ?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
        <?php endforeach; ?>
        <?php endif; ?>

      </select>
      <?php if (!empty($errors['category_id'])) : ?>
      <small class='error'><?= $errors['category_id'] ?></small>
      <?php endif; ?>

      <?php
        $query = 'select * from artists order by name asc';
        $artists = db_query($query);
        ?>


      <select name="artist_id" class="form-control my-1">
        <option value="">--Select Artist--</option>
        <?php if (!empty($artists)) : ?>
        <?php foreach ($artists as $art) : ?>
        <option <?= set_selected('artist_id', $art['id']) ?> value="<?=$art['id']?>"><?=$art['name']?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <?php if (!empty($errors['artist_id'])) : ?>
      <small class='error'><?= $errors['artist_id'] ?></small>
      <?php endif; ?>

      <div class='form-control my-1'>
        <div class="mb-1">Image</div>
        <input type="file" name="image">

        <?php if (!empty($errors['image'])) : ?>
        <small class='error'><?= $errors['image'] ?></small>
        <?php endif; ?>

      </div>

      <div class='form-control my-1'>
        <div class="mb-1">Audio File</div>
        <input type="file" name="audio">

        <?php if (!empty($errors['audio'])) : ?>
        <small class='error'><?= $errors['audio'] ?></small>
        <?php endif; ?>
      </div>


      <a href="<?= ROOT ?>/admin/songs">
        <button class="btn bg-back">Back</button>
      </a>
      <button class="btn bg-warning float-end">Save</button>
    </form>
  </section>

  <?php elseif ($action == 'edit') : ?>

  <section class="mw400">
    <form method="post" enctype="multipart/form-data">
      <h3>Edit Song</h3>

      <?php if (!empty($row)) : ?>

      <input class="form-control my-1" value="<?= set_value('title', $row['title']) ?>" type="text" name="title"
        placeholder="Song title">
      <?php if (!empty($errors['title'])) : ?>
      <small class='error'><?= $errors['title'] ?></small>
      <?php endif; ?>

      <?php
        $query = 'select * from categories order by category asc';
        $categories = db_query($query);
        ?>

      <select name="category_id" class="form-control my-1">
        <option value="">--Select Category--</option>

        <?php if (!empty($categories)) : ?>
        <?php foreach ($categories as $cat) : ?>
        <option <?= set_selected('category_id', $cat['id'], $row['category_id']) ?> value="<?=$cat['id']?>">
          <?=$cat['category']?></option>
        <?php endforeach; ?>
        <?php endif; ?>

      </select>
      <?php if (!empty($errors['category_id'])) : ?>
      <small class='error'><?= $errors['category_id'] ?></small>
      <?php endif; ?>

      <?php
        $query = 'select * from artists order by name asc';
        $artists = db_query($query);
        ?>


      <select name="artist_id" class="form-control my-1">
        <option value="">--Select Artist--</option>
        <?php if (!empty($artists)) : ?>
        <?php foreach ($artists as $art) : ?>
        <option <?= set_selected('artist_id', $art['id'], $row['artist_id']) ?> value="<?=$art['id']?>">
          <?=$art['name']?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <?php if (!empty($errors['artist_id'])) : ?>
      <small class='error'><?= $errors['artist_id'] ?></small>
      <?php endif; ?>

      <div class='form-control my-1'>
        <div class="mb-1">Image</div>

        <img class="image" src="<?=ROOT?>/<?=$row['image']?>" alt="<?=$row['image']?>">
        <input type="file" name="image">
        <?php if (!empty($errors['image'])) : ?>
        <small class='error'><?= $errors['image'] ?></small>
        <?php endif; ?>

      </div>

      <div class='form-control my-1'>
        <div class="mb-1">Audio File</div>
        <div><?=$row['audio']?></div>
        <input type="file" name="audio">

        <?php if (!empty($errors['audio'])) : ?>
        <small class='error'><?= $errors['audio'] ?></small>
        <?php endif; ?>
      </div>



      <a href="<?= ROOT ?>/admin/songs">
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
      <h3>Delete Song</h3>

      <?php if (!empty($row)) : ?>


      <div class='form-control my-1'><?= set_value('title', $row['title']) ?></div>

      <?php if (!empty($errors['title'])) : ?>
      <small class='error'><?= $errors['title'] ?></small>
      <?php endif; ?>


      <a href="<?= ROOT ?>/admin/songs">
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
    $query = 'select * from songs order by id desc limit 20';
    $rows = db_query($query);
    ?>

  <a href="<?= ROOT ?>/admin/songs/add">
    <button class="float-end btn bg-purple mb-3">Add New</button>
  </a>


  <table class=" table">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Image</th>
      <th>Category</th>
      <th>Artist</th>
      <th>Audio</th>
      <th>Action</th>
    </tr>

    <?php if (!empty($rows)) : ?>
    <?php foreach ($rows as $row) : ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['title'] ?></td>
      <td><img class='artist_img' src="<?= ROOT ?>/<?= $row['image'] ?>" alt=""></td>
      <td><?=get_category($row['category_id'])?> </td>
      <td><?=get_artist($row['artist_id'])?> </td>
      <td>
        <audio controls>
          <source src="<?=ROOT?>/<?=$row['audio']?>" type="audio/mpeg">
        </audio>
      </td>

      <td>
        <a href="<?= ROOT ?>/admin/songs/edit/<?= $row['id'] ?>">
          <img class="bi" src="<?= ROOT ?>/assets/icons/pencil-square.svg" alt="">
        </a>
        <a href="<?= ROOT ?>/admin/songs/delete/<?= $row['id'] ?>">
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