<?php

$slug = $URL[1] ?? null;
$query = 'select * from songs where slug = :slug limit 1';
$row = db_query($query, ['slug' => $slug], 'one');



if ($row) {
  header('Content-Description: File Transfer');
  header('Content-Type: ' . mime_content_type($row['audio']));
  header('Content-Disposition: attachment; filename="' . basename($row['audio']) . '"');
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Pragma: public');
  header('Content-Length: ' . filesize($row['audio']));
  ob_clean();
  flush();
  readfile($row['audio']);
  exit();
}

echo "Song not found!";
