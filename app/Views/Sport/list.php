<?= $this->setVar('title', 'Activités')->extend('Layout/backoffice') ?>


<?php
$sports = [
  ['id' => 1, 'nom' => 'Activité sportive 1', 'var_poids_jour' => -12],
  ['id' => 2, 'nom' => 'Activité sportive 2', 'var_poids_jour' => 0],
  ['id' => 3, 'nom' => 'Activité sportive 3', 'var_poids_jour' => -17],
  ['id' => 4, 'nom' => 'Activité sportive 4', 'var_poids_jour' => -2],
  ['id' => 5, 'nom' => 'Activité sportive 5', 'var_poids_jour' => -1],
];
?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Activités sportives</h1>
  <p>Gérez les activités sportives proposées.</p>
</div>
<div class="topbar-actions">
  <a href="<?= base_url('/backoffice/sports/new') ?>" class="btn btn-primary">Créer une nouvelle activité</a>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<table>
  <tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Variation de poids</th>
    <th></th>
  </tr>
  <?php foreach ($sports as $sport): ?>
    <tr>
      <td><?= esc($sport['id']) ?></td>
      <td><?= esc($sport['nom']) ?></td>
      <td><?= ($sport['var_poids_jour'] > 0 ? '+' : '') . esc($sport['var_poids_jour']) ?> g/jour</td>
      <td>
        <div class="table-actions">
          <a href="<?= base_url("/backoffice/sports/{$sport['id']}/edit") ?>" class="btn btn-other">Modifier</a>
          <button type="button" class="btn btn-danger delete-button"
                  data-nom="<?= esc($sport['nom']) ?>" data-url="<?= base_url("/backoffice/sports/{$sport['id']}/delete") ?>">
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
    <p>Êtes-vous sûr de vouloir supprimer <strong id="nom-sport-span"></strong> ? Cette action est irréversible.</p>
    <form id="delete-form" method="post" action="<?= base_url('/backoffice/sports/delete') ?>">
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
  const nomSportSpan = document.getElementById('nom-sport-span');
  deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
      const nom = this.getAttribute('data-nom');
      const url = this.getAttribute('data-url');
      deleteForm.setAttribute('action', url);
      nomSportSpan.textContent = nom;
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
