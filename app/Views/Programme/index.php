<?= $this->setVar('title', 'Programme')->extend('Layout/frontoffice') ?>


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
      <a class="btn btn-primary" href="<?= base_url('/frontoffice/programmes/new') ?>">Planifier un programme</a>
    </div>
  </section>
<?php else: ?>
  <section class="front-banner">
    <div class="front-banner-content">
      <h2>Objectif :
        <?php switch ($programme['objectif']) {
          case 'augmenter':
            echo 'Augmenter le poids';
            break;
          case 'reduire':
            echo 'Réduire le poids';
            break;
          default:
            echo 'Atteindre l’IMC idéal';
        } ?>
      </h2>
      <p>Avoir <?= esc($programme['poids_cible']) ?> kg</p>
    </div>
    <div class="front-banner-actions">
      <a class="btn btn-danger" href="<?= base_url('/frontoffice/programme/stop') ?>">Arrêter</a>
      <a class="btn btn-primary" href="<?= base_url('/frontoffice/programme/pdf') ?>">Exporter en PDF</a>
    </div>
  </section>
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
