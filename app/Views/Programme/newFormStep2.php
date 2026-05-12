<?= $this->setVar('title', 'Nouveau programme')->extend('Layout/frontoffice') ?>


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
