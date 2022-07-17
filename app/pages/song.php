<?php require page('includes/header') ?>

<section class="content">

  <?php
  $slug = $URL[1] ?? null;
  $query = 'select * from songs where slug = :slug limit 1';
  $row = db_query($query, ['slug' => $slug], 'one');
  ?>


  <?php if (!empty($row)) : ?>
    <?php include page('song-full') ?>
  <?php endif; ?>
</section>

<?php require page('includes/footer') ?>