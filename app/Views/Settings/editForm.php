<?= $this->setVar('title', 'Paramètres')->extend('Layout/backoffice') ?>


<?php $errors = session()->getFlashdata('errors') ?? [] ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Paramètres</h1>
  <p>Configurez certains paramètres.</p>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="content-shell">
  <form method="post" action="<?= base_url("/backoffice/settings/edit") ?>">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="prix_gold">Prix de l’option GOLD</label>
      <div class="input-with-suffix">
        <input id="prix_gold" name="prix_gold" type="number" value="<?= old('prix_gold', $settings['prix_gold']) ?>" step="100" min="0" max="1000000" placeholder="100000" required>
        <span class="suffix">Ar</span>
      </div>
      <small class="error-text"><?= $errors['prix_gold'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="reduction_gold">Réduction de l’option GOLD</label>
      <div class="input-with-suffix">
        <input id="reduction_gold" name="reduction_gold" type="number" value="<?= old('reduction_gold', $settings['reduction_gold']) ?>" step="0.01" min="0" max="100" placeholder="15" required>
        <span class="suffix">%</span>
      </div>
      <small class="error-text"><?= $errors['reduction_gold'] ?? '' ?></small>
    </div>

    <button class="btn btn-primary" type="submit">Mettre à jour les paramètres</button>
  </form>
</section>
<?= $this->endSection() ?>
