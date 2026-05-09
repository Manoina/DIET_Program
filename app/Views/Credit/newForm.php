<?= $this->setVar('title', 'Nouveau crédit')->extend('Layout/backoffice') ?>


<?php $errors = session()->getFlashdata('errors') ?? []; ?>
<?php $code = 14824686176487; ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Nouveau crédit</h1>
  <p>Créer un nouveau crédit.</p>
</div>
<div class="topbar-actions">
  <a href="<?= base_url('/backoffice/credits') ?>" class="btn btn-other">Retour</a>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="content-shell">
  <form method="post" action="<?= base_url('/backoffice/credits/new') ?>">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="valeur">Valeur du crédit</label>
      <div class="input-with-suffix">
        <input id="valeur" name="valeur" type="number" value="<?= old('valeur', 0) ?>" step="100" min="0" placeholder="0" required>
        <span class="suffix">Ar</span>
      </div>
      <small class="error-text"><?= $errors['valeur'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="code">Code du crédit</label>
      <input id="code" name="code" type="text" value="<?= old('code', $code) ?>" placeholder="Code du crédit" required>
      <small class="error-text"><?= $errors['code'] ?? '' ?></small>
    </div>

    <button class="btn btn-primary" type="submit">Ajouter le crédit</button>
  </form>
</section>
<?= $this->endSection() ?>
