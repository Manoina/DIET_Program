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
        <h3><?= session('admin')['nom'] ?></h3>
      </div>
    </div>

    <nav class="sidebar-nav" aria-label="Sidebar">
      <a class="nav-link <?= str_starts_with(uri_string(), 'backoffice/dashboard') ? 'active' : '' ?>" href="<?= base_url('/backoffice/dashboard') ?>">Tableau de bord</a>
      <a class="nav-link <?= str_starts_with(uri_string(), 'backoffice/regimes') ? 'active' : '' ?>" href="<?= base_url('/backoffice/regimes') ?>">Régimes</a>
      <a class="nav-link <?= str_starts_with(uri_string(), 'backoffice/sports') ? 'active' : '' ?>" href="<?= base_url('/backoffice/sports') ?>">Activités sportives</a>
      <a class="nav-link <?= str_starts_with(uri_string(), 'backoffice/credits') && uri_string() != 'backoffice/credits/pending' ? 'active' : '' ?>" href="<?= base_url('/backoffice/credits') ?>">Crédits</a>
      <a class="nav-link <?= uri_string() == 'backoffice/credits/pending' ? 'active' : '' ?>" href="<?= base_url('/backoffice/credits/pending') ?>">Crédits en attente</a>
      <a class="nav-link <?= str_starts_with(uri_string(), 'backoffice/settings') ? 'active' : '' ?>" href="<?= base_url('/backoffice/settings') ?>">Paramètres</a>
    </nav>

    <div class="sidebar-actions">
      <a href="<?= base_url('/backoffice/logout') ?>" class="btn btn-danger">Se déconnecter</a>
    </div>
  </aside>

  <main class="main-content">
    <header class="topbar">
      <?= $this->renderSection('topbar') ?>
    </header>

    <?php if (session()->getFlashdata('success') !== null): ?>
      <div class="info good">
        <strong>Succès :</strong> <?= esc(session()->getFlashdata('success')) ?>
      </div>
    <?php elseif (session()->getFlashdata('error') !== null): ?>
      <div class="info bad">
        <strong>Erreur :</strong> <?= esc(session()->getFlashdata('error')) ?>
      </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
  </main>
</body>
</html>
