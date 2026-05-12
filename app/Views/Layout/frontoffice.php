<?php
$title = $title ?? '…'; // Le titre de la page
?>

<?php
$user = model('UserModel')->find(session()->get('user_id'));
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
        <h3><?= $user['nom'] ?></h3>
        <p><?= $user['solde'] ?> Ar</p>
      </div>
    </div>

    <nav class="sidebar-nav">
      <a class="nav-link <?= str_starts_with(uri_string(), 'frontoffice/programme') ? 'active' : '' ?>" href="<?= base_url('/frontoffice/programme') ?>">Mon programme</a>
      <a class="nav-link <?= str_starts_with(uri_string(), 'frontoffice/credit') ? 'active' : '' ?>" href="<?= base_url('/frontoffice/credit/historique') ?>">Mes crédits</a>
      <a class="nav-link <?= str_starts_with(uri_string(), 'frontoffice/gold') ? 'active' : '' ?>" href="<?= base_url('/frontoffice/gold') ?>">Option GOLD</a>
      <a class="nav-link <?= str_starts_with(uri_string(), 'frontoffice/profil') ? 'active' : '' ?>" href="<?= base_url('/frontoffice/profil') ?>">Mon profil</a>
    </nav>

    <div class="sidebar-actions">
      <a href="<?= base_url('/frontoffice/logout') ?>" class="btn btn-danger">Se déconnecter</a>
    </div>
  </aside>

  <main class="main-content">
    <header class="topbar front-topbar">
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
