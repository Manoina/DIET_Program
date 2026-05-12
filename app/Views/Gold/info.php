<?= $this->setVar('title', 'Option GOLD')->extend('Layout/frontoffice') ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Option GOLD</h1>
  <p>Comprenez les avantages de l’option GOLD.</p>
</div>
<div class="topbar-actions">
  <button type="button" id="buy-gold-button" class="btn btn-primary">Mettre à niveau vers l’option GOLD</button>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="flex-row">
  <section class="content-shell flex-grow">
    <h3 class="section-header">Fonctionnalités Standard <span class="price">Gratuit</span></h3>
    <dl class="details-list">
      <div>
        <dt>Régimes</dt>
        <dd>Tout disponible</dd>
      </div>
      <div>
        <dt>Activités sportives</dt>
        <dd>Tout disponible</dd>
      </div>
      <div>
        <dt>Assistance</dt>
        <dd>Non</dd>
      </div>
    </dl>
  </section>
  <section class="content-shell flex-grow">
    <h3 class="section-header">Options GOLD <span class="price"><?= $prix_gold ?> Ar</span></h3>
    <dl class="details-list">
      <div>
        <dt>Prix des régimes</dt>
        <dd>-<?= $reduction_gold ?>%</dd>
      </div>
      <div>
        <dt>Accès</dt>
        <dd>Accès à vie</dd>
      </div>
      <div>
        <dt>Assistance</dt>
        <dd>Oui</dd>
      </div>
    </dl>
  </section>
</div>

<div id="confirm-modal" class="modal">
  <div class="modal-overlay"></div>
  <div class="modal-content">
    <h3>Confirmer la mise à niveau</h3>
    <p>Êtes-vous sûr d’acheter l’option GOLD pour <strong><?= $prix_gold ?> Ar</strong> ?</p>
    <form id="confirm-form" method="post" action="<?= base_url('/frontoffice/gold/acheter') ?>">
      <?= csrf_field() ?>
      <div class="modal-actions">
        <button type="button" class="btn btn-other" id="cancel-confirm-button">Annuler</button>
        <button type="submit" class="btn btn-primary">Acheter</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('confirm-modal');
  const buyGoldButton = document.getElementById('buy-gold-button');
  const cancelConfirmButton = document.getElementById('cancel-confirm-button');
  buyGoldButton.addEventListener('click', function() {
    modal.style.display = 'block';
  });
  cancelConfirmButton.addEventListener('click', function() {
    modal.style.display = 'none';
  });
  modal.querySelector('.modal-overlay').addEventListener('click', function() {
    modal.style.display = 'none';
  });
});
</script>
<?= $this->endSection() ?>
