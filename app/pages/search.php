<?php require page('includes/header') ?>

<section class="content">

  <?php
  $title = $_GET['find'] ?? null;
  if (!empty($title)) {

    $title = "%$title%";
    $query = 'select * from songs where title like :title order by views desc limit 24';
    $rows = db_query($query, ['title' => $title]);
  }

  ?>


  <?php if (!empty($rows)) : ?>
    <?php foreach ($rows as $row) : ?>
      <?php include page('includes/song') ?>
    <?php endforeach; ?>
  <?php else : ?>
    <div class="m-2">No Songs Found</div>
  <?php endif; ?>
</section>

<?php require page('includes/footer') ?>