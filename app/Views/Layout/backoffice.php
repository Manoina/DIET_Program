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
<body class="bo">
  <aside class="sidebar">
    <div class="brand">
      <div class="brand-mark">DIET</div>
      <span class="brand-sub">Backoffice</span>
    </div>

    <div class="profile">
      <img class="avatar" src="<?= base_url('/assets/images/avatar-admin.jpg') ?>">
      <div class="profile-info">
        <h3>Nom de l’admin</h3>
        <p>admin@example.com</p>
      </div>
    </div>

    <nav class="sidebar-nav" aria-label="Sidebar">
      <a class="nav-link active" href="<?= base_url('/backoffice/dashboard') ?>">Tableau de bord</a>
      <a class="nav-link" href="<?= base_url('/backoffice/regimes') ?>">Régimes</a>
      <a class="nav-link" href="<?= base_url('/backoffice/sports') ?>">Activités sportives</a>
      <a class="nav-link" href="<?= base_url('/backoffice/credits') ?>">Crédits</a>
      <a class="nav-link" href="<?= base_url('/backoffice/credits/pending') ?>">Crédits en attente</a>
      <a class="nav-link" href="<?= base_url('/backoffice/settings') ?>">Paramètres</a>
    </nav>

    <div class="sidebar-actions">
      <a class="btn btn-danger">Se déconnecter</a>
    </div>
  </aside>

  <main class="main-content">
    <header class="topbar">
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
