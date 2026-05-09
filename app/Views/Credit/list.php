<?= $this->setVar('title', 'Crédits')->extend('Layout/backoffice') ?>


<?php
$credits = [
  ['id' => 1, 'valeur' => 10000, 'code' => '79438745728652'],
  ['id' => 2, 'valeur' => 20000, 'code' => '79438745728652'],
  ['id' => 3, 'valeur' => 5000, 'code' => '79438745728652'],
  ['id' => 4, 'valeur' => 2000, 'code' => '79438745728652'],
  ['id' => 5, 'valeur' => 10000, 'code' => '79438745728652'],
];
?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Crédits</h1>
  <p>Gérez les crédits.</p>
</div>
<div class="topbar-actions">
  <a href="<?= base_url('/backoffice/credits/new') ?>" class="btn btn-primary">Ajouter un nouveau crédit</a>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<table>
  <tr>
    <th>ID</th>
    <th>Valeur</th>
    <th>Code</th>
    <th></th>
  </tr>
  <?php foreach ($credits as $credit): ?>
    <tr>
      <td><?= esc($credit['id']) ?></td>
      <td><?= esc($credit['valeur']) ?> Ar</td>
      <td><?= esc($credit['code']) ?></td>
      <td>
        <div class="table-actions">
          <a href="<?= base_url("/backoffice/credits/{$credit['id']}/edit") ?>" class="btn btn-other">Modifier</a>
          <button type="button" class="btn btn-danger delete-button"
                  data-nom="<?= esc($credit['valeur']) ?>" data-url="<?= base_url("/backoffice/credits/{$credit['id']}/delete") ?>">
            Supprimer
          </button>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<div id="delete-modal" class="modal">
  <div class="modal-overlay"></div>
  <div class="modal-content">
    <h3>Confirmer la suppression</h3>
    <p>Êtes-vous sûr de vouloir supprimer le crédit de <strong><span id="valeur-credit-span"></span> Ar</strong> ? Cette action est irréversible.</p>
    <form id="delete-form" method="post" action="<?= base_url('/backoffice/credits/delete') ?>">
      <?= csrf_field() ?>
      <div class="modal-actions">
        <button type="button" class="btn btn-other" id="cancel-delete-button">Annuler</button>
        <button type="submit" class="btn btn-danger">Supprimer</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('delete-modal');
  const deleteButtons = document.querySelectorAll('.delete-button');
  const cancelDeleteButton = document.getElementById('cancel-delete-button');
  const deleteForm = document.getElementById('delete-form');
  const valeurCreditSpan = document.getElementById('valeur-credit-span');
  deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
      const nom = this.getAttribute('data-nom');
      const url = this.getAttribute('data-url');
      deleteForm.setAttribute('action', url);
      valeurCreditSpan.textContent = nom;
      modal.style.display = 'block';
    });
  });
  cancelDeleteButton.addEventListener('click', function() {
    modal.style.display = 'none';
  });
  modal.querySelector('.modal-overlay').addEventListener('click', function() {
    modal.style.display = 'none';
  });
});
</script>
<?= $this->endSection() ?>
