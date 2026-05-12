<?= $this->setVar('title', 'Modification d’un crédit')->extend('Layout/backoffice') ?>


<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<?php
// $credit = ['id' => 3, 'valeur' => 5000, 'code' => '79438745728652'];
$credit = $credit ?? [];
?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Modification du crédit de : <?= esc($credit['valeur']) ?> Ar</h1>
  <p>Modifiez certaines caractéristiques du crédit.</p>
</div>
<div class="topbar-actions">
  <a href="<?= base_url('/backoffice/credits') ?>" class="btn btn-other">Retour</a>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="content-shell">
  <form method="post" action="<?= base_url("/backoffice/credits/{$credit['id']}/edit") ?>">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="valeur">Valeur du crédit</label>
      <div class="input-with-suffix">
        <input id="valeur" name="valeur" type="number" value="<?= old('valeur', $credit['valeur']) ?>" step="100" min="0" placeholder="0" required>
        <span class="suffix">Ar</span>
      </div>
      <small class="error-text"><?= $errors['valeur'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="code">Code du crédit</label>
      <input id="code" name="code" type="text" value="<?= old('code', $credit['code']) ?>" placeholder="Code du crédit" required>
      <small class="error-text"><?= $errors['code'] ?? '' ?></small>
    </div>

    <button class="btn btn-primary" type="submit">Modifier le crédit</button>
  </form>
</section>
<?= $this->endSection() ?>
