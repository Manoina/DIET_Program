<?= $this->setVar('title', 'Programme')->extend('Layout/frontoffice') ?>


<?php
// $programme = null;
$programme = ['id' => 1, 'date_fin' => '2026-05-20', 'regime' => ['nom' => 'Régime 1', 'taux_poisson' => 25, 'taux_viande' => 25, 'taux_volaille' => 25], 'sports' => [['nom' => 'Sport 1', 'quantite' => 1], ['nom' => 'Sport 1', 'quantite' => 1], ['nom' => 'Sport 1', 'quantite' => 1]]];
?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Programme</h1>
  <p>Consultez votre régime et vos activités sportives.</p>
</div>
<div class="topbar-actions">
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<?php if ($programme === null): ?>
  <section class="front-banner" aria-label="Résumé rapide">
    <div class="front-banner-content">
      <h2>Bienvenue</h2>
      <p>Vous ne suivez pas encore de programme. Planifiez-le maintenant.</p>
    </div>
    <div class="front-banner-actions">
      <a class="btn btn-primary" href="<?= base_url('/frontoffice/sports') ?>">Planifier un programme</a>
    </div>
  </section>
<?php else: ?>
  <div class="flex-row">
    <section class="content-shell flex-grow">
      <h3 class="section-header"><?= esc($programme['regime']['nom']) ?></h3>
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
        <div>
          <dt>Date de fin</dt>
          <dd><?= esc($programme['date_fin']) ?></dd>
        </div>
      </dl>
    </section>
    <section class="content-shell flex-grow">
      <h3 class="section-header">Activités sportives</h3>
      <dl class="details-list">
        <?php foreach ($programme['sports'] as $sport): ?>
          <div>
            <dt><?= esc($sport['nom']) ?></dt>
            <dd>×<?= esc($sport['quantite']) ?></dd>
          </div>
        <?php endforeach; ?>
      </dl>
    </section>
  </div>
<?php endif; ?>
<?= $this->endSection() ?>
