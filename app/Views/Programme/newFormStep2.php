<?= $this->setVar('title', 'Nouveau programme')->extend('Layout/frontoffice') ?>


<?php
$programmes = [
  ['id' => 1, 'regime' => ['nom' => 'Régime 1', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => [['nom' => 'Sport 1', 'quantite' => 1], ['nom' => 'Sport 1', 'quantite' => 1], ['nom' => 'Sport 1', 'quantite' => 1]]],
  ['id' => 2, 'regime' => ['nom' => 'Régime 2', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => []],
  ['id' => 3, 'regime' => ['nom' => 'Régime 3', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => [['nom' => 'Sport 3', 'quantite' => 3], ['nom' => 'Sport 3', 'quantite' => 3], ['nom' => 'Sport 3', 'quantite' => 3]]],
  ['id' => 4, 'regime' => ['nom' => 'Régime 4', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => [['nom' => 'Sport 4', 'quantite' => 4], ['nom' => 'Sport 4', 'quantite' => 4]]],
  ['id' => 5, 'regime' => ['nom' => 'Régime 5', 'prix' => '10000', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => [['nom' => 'Sport 5', 'quantite' => 5], ['nom' => 'Sport 5', 'quantite' => 5], ['nom' => 'Sport 5', 'quantite' => 5]]],
];
?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Nouveau programme</h1>
  <p>Planifiez votre régime et vos activités sportives.</p>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<form method="post" action="<?= base_url('/frontoffice/programmes/new') ?>" class="content-shell">
  <?= csrf_field() ?>

  <div style="display: flex; gap: 24px; flex-wrap: wrap; justify-content: center; margin-bottom: 24px;">
    <?php foreach ($programmes as $programme): ?>
      <section class="content-shell">
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
      </section>
    <?php endforeach; ?>
  </div>

  <button type="submit" class="btn btn-primary">Valider le programme</button>
</form>
<?= $this->endSection() ?>
