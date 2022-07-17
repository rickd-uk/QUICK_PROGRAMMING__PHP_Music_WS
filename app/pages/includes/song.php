<div class='music-card'>
  <div style="overflow: hidden;">
    <a href="<?= ROOT ?>/song/<?= $row['slug'] ?>"><img src="<?= ROOT ?>/<?= $row['image'] ?>" alt=""></a>
  </div>
  <div class="card-content">
    <div class="card-title" style="font-size: 0.8rem; margin-bottom: 0.5rem;"><?= esc($row['title']) ?></div>
    <div class="card-subtitle" style="color:darkcyan; font-style:oblique;"><?= esc(get_artist($row['artist_id'])) ?></div>
    <div class="card-subtitle" style="background-color:dimgrey; font-size: 14px; color:white; padding: 5px; margin-top: 0.5rem; text-align: center; border-top: 1px solid gray; font-weight:800;"><?= esc(get_category($row['category_id'])) ?></div>
  </div>
</div>