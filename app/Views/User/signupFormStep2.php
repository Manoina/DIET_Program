<?= $this->setVar('title', 'Inscription')->extend('Layout/modal') ?>


<?php $errors = session()->getFlashdata('errors') ?? [] ?>


<?= $this->section('content') ?>
<h1 class="form-title">Inscription</h1>
<form action="<?= base_url('/frontoffice/signup/sante') ?>" method="post">
  <?= csrf_field() ?>

  <div class="form-group">
    <label for="taille">Taille</label>
    <div class="input-with-suffix">
      <input id="taille" name="taille" type="number" value="<?= old('taille', '') ?>" step="1" min="0" max="300" placeholder="150" required>
      <span class="suffix">cm</span>
    </div>
    <small class="error-text"><?= $errors['taille'] ?? '' ?></small>
  </div>

  <div class="form-group">
    <label for="poids">Poids</label>
    <div class="input-with-suffix">
      <input id="poids" name="poids" type="number" value="<?= old('poids', '') ?>" step="0.01" min="0" max="200" placeholder="50" required>
      <span class="suffix">kg</span>
    </div>
    <small class="error-text"><?= $errors['poids'] ?? '' ?></small>
  </div>

  <a href="<?= base_url('/frontoffice/signup') ?>" class="btn btn-other" style="margin-bottom: 18px;">Retour</a>
  <button type="submit" class="btn btn-primary">Terminer l’inscription</button>
</form>
<?= $this->endSection() ?>
