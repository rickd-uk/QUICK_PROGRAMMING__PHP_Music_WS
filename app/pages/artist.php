<?php require page('includes/header') ?>

<section class="content">

  <?php
  $id = $URL[1] ?? null;
  $query = 'select * from artists where id = :id limit 1';
  $row = db_query($query, ['id' => $id], 'one');
  ?>


  <?php if (!empty($row)) : ?>
    <?php include page('artist-full') ?>
  <?php endif; ?>
</section>

<?php require page('includes/footer') ?>