<?= $this->setVar('title', 'Crédits en attente')->extend('Layout/backoffice') ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Crédits en attente</h1>
  <p>Gérez les crédits rentrés par les utilisateurs.</p>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<table>
  <tr>
    <th>Demande</th>
    <th>Valeur</th>
    <th>Code</th>
    <th>Utilisateur</th>
    <th>Date</th>
    <th></th>
  </tr>
  <?php foreach ($demandes as $demande): ?>
    <tr>
      <td><?= esc($demande['id_demande']) ?></td>
      <td><?= esc($demande['valeur']) ?> Ar</td>
      <td><?= esc($demande['code']) ?></td>
      <td><?= esc($demande['nom']) ?></td>
      <td><?= esc($demande['date_demande']) ?></td>
      <td>
        <div class="table-actions">
          <button type="button" class="btn btn-danger refuse-button"
                  data-id="<?= esc($demande['id_demande']) ?>" data-url="<?= base_url("/backoffice/credits/refuser/{$demande['id_demande']}") ?>">
            Refuser
          </button>
          <button type="button" class="btn btn-primary accept-button"
                  data-id="<?= esc($demande['id_demande']) ?>" data-url="<?= base_url("/backoffice/credits/accepter/{$demande['id_demande']}") ?>">
            Accepter
          </button>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<div id="refuse-modal" class="modal">
  <div class="modal-overlay"></div>
  <div class="modal-content">
    <h3>Confirmer le refus</h3>
    <p>Êtes-vous sûr de vouloir refuser la demande <strong><span id="id-credit-refuse-span"></span></strong> ?</p>
    <form id="refuse-form" method="post">
      <?= csrf_field() ?>
      <div class="modal-actions">
        <button type="button" class="btn btn-other" id="cancel-refuse-button">Annuler</button>
        <button type="submit" class="btn btn-danger">Refuser</button>
      </div>
    </form>
  </div>
</div>


<div id="accept-modal" class="modal">
  <div class="modal-overlay"></div>
  <div class="modal-content">
    <h3>Confirmer l’acceptation</h3>
    <p>Êtes-vous sûr de vouloir accepter la demande <strong><span id="id-credit-accept-span"></span></strong> ?</p>
    <form id="accept-form" method="post">
      <?= csrf_field() ?>
      <div class="modal-actions">
        <button type="button" class="btn btn-other" id="cancel-accept-button">Annuler</button>
        <button type="submit" class="btn btn-primary">Accepter</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const refuseModal = document.getElementById('refuse-modal');
  const acceptModal = document.getElementById('accept-modal');
  const refuseButtons = document.querySelectorAll('.refuse-button');
  const acceptButtons = document.querySelectorAll('.accept-button');
  const cancelRefuseButton = document.getElementById('cancel-refuse-button');
  const cancelAcceptButton = document.getElementById('cancel-accept-button');
  const refuseForm = document.getElementById('refuse-form');
  const acceptForm = document.getElementById('accept-form');
  const idCreditRefuseSpan = document.getElementById('id-credit-refuse-span');
  const idCreditAcceptSpan = document.getElementById('id-credit-accept-span');
  refuseButtons.forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      const url = this.getAttribute('data-url');
      refuseForm.setAttribute('action', url);
      idCreditRefuseSpan.textContent = id;
      refuseModal.style.display = 'block';
    });
  });
  acceptButtons.forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      const url = this.getAttribute('data-url');
      acceptForm.setAttribute('action', url);
      idCreditAcceptSpan.textContent = id;
      acceptModal.style.display = 'block';
    });
  });
  cancelRefuseButton.addEventListener('click', function() {
    refuseModal.style.display = 'none';
  });
  cancelAcceptButton.addEventListener('click', function() {
    acceptModal.style.display = 'none';
  });
  refuseModal.querySelector('.modal-overlay').addEventListener('click', function() {
    refuseModal.style.display = 'none';
  });
  acceptModal.querySelector('.modal-overlay').addEventListener('click', function() {
    acceptModal.style.display = 'none';
  });
});
</script>
<?= $this->endSection() ?>
