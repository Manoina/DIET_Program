<?= $this->setVar('title', 'Nouvelle activité')->extend('Layout/backoffice') ?>


<?php $errors = session()->getFlashdata('errors') ?? [] ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Nouvelle activité sportive</h1>
  <p>Concevez une nouvelle activité sportive.</p>
</div>
<div class="topbar-actions">
  <a href="<?= base_url('/backoffice/sports') ?>" class="btn btn-other">Retour</a>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="content-shell">
  <form method="post" action="<?= base_url('/backoffice/sports/new') ?>">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="nom">Nom de l’activité</label>
      <input id="nom" name="nom" type="text" value="<?= old('nom', '') ?>" placeholder="Nom de l’activité" required>
      <small class="error-text"><?= $errors['nom'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="var_poids_jour">Variation du poids par jour</label>
      <div class="input-with-suffix">
        <input id="var_poids_jour" name="var_poids_jour" type="number" value="<?= old('var_poids_jour', -30) ?>" step="0.01" min="-1000" max="1000" placeholder="-30" required>
        <span class="suffix">g/jour</span>
      </div>
      <small class="error-text"><?= $errors['var_poids_jour'] ?? '' ?></small>
    </div>

    <button class="btn btn-primary" type="submit">Ajouter la nouvelle activité</button>
  </form>
</section>
<?= $this->endSection() ?>
