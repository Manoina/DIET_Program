<?php $error= session()->getFlashdata('error') ?? ''; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIET | Connexion</title>
  <link rel="stylesheet" href="<?= base_url('/assets/css/global.css') ?>">
</head>
<body>
  <div class="modal" style="display: block;">
    <div class="modal-content">
      <h1 class="form-title">Connexion</h1>
      <form action="<?= base_url('/frontoffice/login') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="" required>
        </div>

        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" value="" required>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
        <small class="error-text"><?= $error ?></small>

        <hr>
        <p>Vous êtes nouveau ?</p>
        <a href="<?= base_url('/frontoffice/signup') ?>" class="btn btn-other">S’inscrire</a>
      </form>
    </div>
  </div>
</body>
</html>
