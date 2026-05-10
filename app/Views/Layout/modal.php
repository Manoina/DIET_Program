<?php
$title = $title ?? '…'; // Le titre de la page
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIET | <?= $title ?></title>
  <link rel="stylesheet" href="<?= base_url('/assets/css/global.css') ?>">
</head>
<body>
  <div class="modal" style="display: block;">
    <div class="modal-content">
      <?= $this->renderSection('content') ?>
    </div>
  </div>
</body>
</html>
