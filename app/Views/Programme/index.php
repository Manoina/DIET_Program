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
<section class="front-banner" aria-label="Résumé rapide">
  <div class="front-banner-content">
    <h2>Bienvenue</h2>
    <p>Vous ne suivez pas encore de programme. Planifiez-le maintenant.</p>
  </div>
  <div class="front-banner-actions">
    <a class="btn btn-primary" href="<?= base_url('/frontoffice/sports') ?>">Planifier un programme</a>
  </div>
</section>
<?= $this->endSection() ?>
