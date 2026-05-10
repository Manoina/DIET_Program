<?php
$title = $title ?? '…'; // Le titre de la page
?>

<?php
$argent = 120000;
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIET | <?= $title ?></title>
  <link rel="stylesheet" href="<?= base_url('/assets/css/global.css') ?>">
</head>
<body class="bo fo">
  <aside class="sidebar">
    <div class="brand">
      <div class="brand-mark">DIET</div>
      <span class="brand-sub">Espace client</span>
    </div>

    <div class="profile">
      <img class="avatar" src="<?= base_url('/assets/images/avatar-user.jpg') ?>">
      <div class="profile-info">
        <h3>Nom de l’user</h3>
        <p><?= $argent ?> Ar</p>
      </div>
    </div>

    <nav class="sidebar-nav">
      <a class="nav-link active" href="<?= base_url('/frontoffice/programme') ?>">Mon programme</a>
      <a class="nav-link" href="<?= base_url('/frontoffice/credits') ?>">Mes crédits</a>
      <a class="nav-link" href="<?= base_url('/frontoffice/gold') ?>">Option GOLD</a>
      <a class="nav-link" href="<?= base_url('/frontoffice/profile') ?>">Mon profil</a>
    </nav>

    <div class="sidebar-actions">
      <a class="btn btn-danger">Se déconnecter</a>
    </div>
  </aside>

  <main class="main-content">
    <header class="topbar front-topbar">
      <?= $this->renderSection('topbar') ?>
    </header>

    <div class="info good">
      <strong>Succès :</strong> Ceci est un message qui indique que tout s’est bien passé.
    </div>
    <div class="info bad">
      <strong>Erreur :</strong> Ceci est un message qui indique que quelque chose s’est mal passée.
    </div>

    <?= $this->renderSection('content') ?>
  </main>
</body>
</html>
