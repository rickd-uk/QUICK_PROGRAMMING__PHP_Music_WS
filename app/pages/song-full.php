<?php

db_query("update songs set views = views + 1 where id = :id limit 1", ['id' => $row['id']]);
?>

<div class='music-card-full' style='max-width: 800px'>
  <h2 class="card-title" style="font-size: 1.5rem;"><?= esc($row['title']) ?></h2>
  <h3 class="card-subtitle"><?= esc(get_artist($row['artist_id'])) ?></h3>

  <div style="overflow: hidden;">
    <a href="<?= ROOT ?>/song/<?= $row['slug'] ?>"><img src="<?= ROOT ?>/<?= $row['image'] ?>" alt=""></a>
  </div>

  <div class="card-content">
    <audio controls style="width: 100%">
      <source src="<?= ROOT ?>/<?= $row['audio'] ?>" type="audio/mpeg">
    </audio>

    <div>Views: <?= $row['views'] ?></div>
    <div>Date Added: <?= get_date($row['date']) ?></div>

    <a href="<?= ROOT ?>/download/<?= $row['slug'] ?>">
      <button class="btn btn-purple">Download</button>
    </a>

  </div>

</div>