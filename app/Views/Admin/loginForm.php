<?= $this->setVar('title', 'Portail administrateur')->extend('Layout/modal') ?>


<?php $error= session()->getFlashdata('error') ?? ''; ?>


<?= $this->section('content') ?>
<h1 class="form-title">Portail administrateur</h1>
<form action="<?= base_url('/backoffice/login') ?>" method="post">
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
</form>
<?= $this->endSection() ?>
