<?= $this->setVar('title', 'Nouveau programme')->extend('Layout/frontoffice') ?>


<?php
$programmes = [
  ['id' => 1, 'regime' => ['id' => 1, 'id' => 1, 'nom' => 'Régime 1', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => [['id' => 1, 'nom' => 'Sport 1', 'quantite' => 1], ['id' => 1, 'nom' => 'Sport 1', 'quantite' => 1], ['id' => 1, 'nom' => 'Sport 1', 'quantite' => 1]]],
  ['id' => 2, 'regime' => ['id' => 2, 'id' => 1, 'nom' => 'Régime 2', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => []],
  ['id' => 3, 'regime' => ['id' => 3, 'id' => 1, 'nom' => 'Régime 3', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => [['id' => 1, 'nom' => 'Sport 3', 'quantite' => 3], ['id' => 1, 'nom' => 'Sport 3', 'quantite' => 3], ['id' => 1, 'nom' => 'Sport 3', 'quantite' => 3]]],
  ['id' => 4, 'regime' => ['id' => 4, 'id' => 1, 'nom' => 'Régime 4', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => [['id' => 1, 'nom' => 'Sport 4', 'quantite' => 4], ['id' => 1, 'nom' => 'Sport 4', 'quantite' => 4]]],
  ['id' => 5, 'regime' => ['id' => 5, 'id' => 1, 'nom' => 'Régime 5', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => [['id' => 1, 'nom' => 'Sport 5', 'quantite' => 5], ['id' => 1, 'nom' => 'Sport 5', 'quantite' => 5], ['id' => 1, 'nom' => 'Sport 5', 'quantite' => 5]]],
];
?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Nouveau programme</h1>
  <p>Planifiez votre régime et vos activités sportives.</p>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="content-shell">
  <?= csrf_field() ?>

  <div style="display: flex; gap: 24px; flex-wrap: wrap; justify-content: center; margin-bottom: 24px;">
    <?php foreach ($programmes as $programme): ?>
      <form method="post" action="<?= base_url("/frontoffice/programmes/new") ?>" style="min-width: 300px;">
        <?= csrf_field() ?>
        <input type="hidden" name="id_regime" value="<?= esc($programme['regime']['id']) ?>">
        <input type="hidden" name="prix" value="<?= esc($programme['regime']['prix']) ?>">
        <?php foreach ($programme['sports'] as $sport): ?>
          <input type="hidden" name="id_sport[]" value="<?= esc($sport['id']) ?>">
          <input type="hidden" name="quantite_sport[]" value="<?= esc($sport['quantite']) ?>">
        <?php endforeach; ?>

        <section class="content-shell" style="height: 100%; display: flex; flex-direction: column;">
          <h3 class="section-header"><?= esc($programme['regime']['nom']) ?> <span class="price"><?= esc($programme['regime']['prix']) ?> Ar</span></h3>
          <dl class="details-list">
            <div>
              <dt>Taux de viande</dt>
              <dd><?= esc($programme['regime']['taux_viande']) ?>%</dd>
            </div>
            <div>
              <dt>Taux de poisson</dt>
              <dd><?= esc($programme['regime']['taux_poisson']) ?>%</dd>
            </div>
            <div>
              <dt>Taux de volaille</dt>
              <dd><?= esc($programme['regime']['taux_volaille']) ?>%</dd>
            </div>
            <?php foreach ($programme['sports'] as $sport): ?>
              <div>
                <dt><?= esc($sport['nom']) ?></dt>
                <dd>×<?= esc($sport['quantite']) ?></dd>
              </div>
            <?php endforeach; ?>
          </dl>
          <div style="margin-top: 16px;"></div>
          <button type="submit" class="btn btn-primary" style="margin-top: auto;">Choisir ce programme</button>
        </section>
      </form>
    <?php endforeach; ?>
  </div>
  <a href="<?= base_url("/frontoffice/programmes/new") ?>" class="btn btn-other">Retour</a>
</div>
<?= $this->endSection() ?>
