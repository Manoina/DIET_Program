<?= $this->setVar('title', 'Connexion')->extend('Layout/modal') ?>


<?php $error= session()->getFlashdata('error') ?? ''; ?>


<?= $this->section('content') ?>
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
<?= $this->endSection() ?>
