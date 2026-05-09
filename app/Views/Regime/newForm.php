<?= $this->setVar('title', 'Nouveau régime')->extend('Layout/backoffice') ?>


<?php $errors = session()->getFlashdata('errors') ?? [] ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Nouveau régime</h1>
  <p>Concevez un nouveau régime.</p>
</div>
<div class="topbar-actions">
  <a href="<?= base_url('/backoffice/regimes') ?>" class="btn btn-other">Retour</a>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="content-shell">
  <form method="post" action="<?= base_url('/backoffice/regimes/new') ?>">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="nom">Nom du régime</label>
      <input id="nom" name="nom" type="text" value="<?= old('nom', '') ?>" placeholder="Nom du régime" required>
      <small class="error-text"><?= $errors['nom'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="taux_viande">Taux de viande</label>
      <div class="input-with-suffix">
        <input id="taux_viande" name="taux_viande" type="number" value="<?= old('taux_viande', 25) ?>" step="0.01" min="0" max="100" placeholder="25" required>
        <span class="suffix">%</span>
      </div>
      <small class="error-text"><?= $errors['taux_viande'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="taux_poisson">Taux de poisson</label>
      <div class="input-with-suffix">
        <input id="taux_poisson" name="taux_poisson" type="number" value="<?= old('taux_poisson', 25) ?>" step="0.01" min="0" max="100" placeholder="25" required>
        <span class="suffix">%</span>
      </div>
      <small class="error-text"><?= $errors['taux_poisson'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="taux_volaille">Taux de volaille</label>
      <div class="input-with-suffix">
        <input id="taux_volaille" name="taux_volaille" type="number" value="<?= old('taux_volaille', 25) ?>" step="0.01" min="0" max="100" placeholder="25" required>
        <span class="suffix">%</span>
      </div>
      <small class="error-text"><?= $errors['taux_volaille'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="var_poids_jour">Variation du poids par jour</label>
      <div class="input-with-suffix">
        <input id="var_poids_jour" name="var_poids_jour" type="number" value="<?= old('var_poids_jour', -100) ?>" step="0.01" min="-1000" max="1000" placeholder="-100" required>
        <span class="suffix">g/jour</span>
      </div>
      <small class="error-text"><?= $errors['var_poids_jour'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="prix_jour">Prix journalier</label>
      <div class="input-with-suffix">
        <input id="prix_jour" name="prix_jour" type="number" value="<?= old('prix_jour', 8000) ?>" step="100" min="0" max="1000000" placeholder="8000" required>
        <span class="suffix">Ar/jour</span>
      </div>
      <small class="error-text"><?= $errors['prix_jour'] ?? '' ?></small>
    </div>

    <button class="btn btn-primary" type="submit">Ajouter le nouveau régime</button>
  </form>
</section>
<?= $this->endSection() ?>
