<?= $this->setVar('title', 'Crédits en attente')->extend('Layout/backoffice') ?>


<?php
$credits = [
  ['id' => 1, 'valeur' => 10000, 'code' => '79438745728652', 'nom' => 'Rakoto', 'prenom' => 'Jean', 'date_demande' => '2026-05-10'],
  ['id' => 2, 'valeur' => 20000, 'code' => '79438745728652', 'nom' => 'Rakoto', 'prenom' => 'Jean', 'date_demande' => '2026-05-10'],
  ['id' => 3, 'valeur' => 5000, 'code' => '79438745728652', 'nom' => 'Rakoto', 'prenom' => 'Jean', 'date_demande' => '2026-05-10'],
  ['id' => 4, 'valeur' => 2000, 'code' => '79438745728652', 'nom' => 'Rakoto', 'prenom' => 'Jean', 'date_demande' => '2026-05-10'],
  ['id' => 5, 'valeur' => 10000, 'code' => '79438745728652', 'nom' => 'Rakoto', 'prenom' => 'Jean', 'date_demande' => '2026-05-10'],
];
?>


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
  <?php foreach ($credits as $credit): ?>
    <tr>
      <td><?= esc($credit['id']) ?></td>
      <td><?= esc($credit['valeur']) ?> Ar</td>
      <td><?= esc($credit['code']) ?></td>
      <td><?= esc($credit['nom']) ?> <?= esc($credit['prenom']) ?></td>
      <td><?= esc($credit['date_demande']) ?></td>
      <td>
        <div class="table-actions">
          <button type="button" class="btn btn-danger refuse-button"
                  data-id="<?= esc($credit['id']) ?>" data-url="<?= base_url("/backoffice/credits/pending/{$credit['id']}/refuse") ?>">
            Refuser
          </button>
          <button type="button" class="btn btn-primary accept-button"
                  data-id="<?= esc($credit['id']) ?>" data-url="<?= base_url("/backoffice/credits/pending/{$credit['id']}/accept") ?>">
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
