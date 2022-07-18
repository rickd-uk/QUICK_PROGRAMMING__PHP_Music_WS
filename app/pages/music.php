<?php require page('includes/header') ?>

<section class="content">

  <?php
  $limit = 1;
  $offset = ($page - 1) * $limit;

  $rows = db_query("select * from songs order by views desc limit $limit offset $offset");

  // lookahead to hide next button for last page (temporary solution)
  // Wasteful since it calculates it every page
  $offset = $offset + 1;
  $lookahead = db_query("select * from songs order by views desc limit $limit offset $offset");
  ?>


  <?php

  if (!empty($rows)) :
    foreach ($rows as $row) :
      include page('includes/song');
    endforeach;
  endif;
  ?>
</section>

<div class="mx-2">
  <a href="<?= ROOT ?>/music?page=<?= (string)$prev_page ?>">
    <button class="btn bg-orange">Prev.</button>
  </a>

  <?php if (!empty($lookahead)) : ?>
    <a href="<?= ROOT ?>/music?page=<?= (string)$next_page ?>">
      <button class="float-end btn bg-orange">Next</button>
    <?php endif; ?>
    </a>
</div>

<?php require page('includes/footer') ?>