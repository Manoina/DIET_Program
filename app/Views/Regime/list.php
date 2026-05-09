<?= $this->setVar('title', 'Régimes')->extend('Layout/backoffice') ?>


<?php
$regimes = [
  ['id' => 1, 'nom' => 'Régime 1', 'taux_viande' => 12, 'taux_volaille' => 14.90, 'taux_poisson' => 10.25, 'var_poids_jour' => -12, 'prix_jour' => 13],
  ['id' => 2, 'nom' => 'Régime 2', 'taux_viande' => 12, 'taux_volaille' => 14.90, 'taux_poisson' => 10.25, 'var_poids_jour' => 5, 'prix_jour' => 14],
  ['id' => 3, 'nom' => 'Régime 3', 'taux_viande' => 12, 'taux_volaille' => 14.90, 'taux_poisson' => 10.25, 'var_poids_jour' => -17, 'prix_jour' => 15],
  ['id' => 4, 'nom' => 'Régime 4', 'taux_viande' => 12, 'taux_volaille' => 14.90, 'taux_poisson' => 10.25, 'var_poids_jour' => -2, 'prix_jour' => 16],
  ['id' => 5, 'nom' => 'Régime 5', 'taux_viande' => 12, 'taux_volaille' => 14.90, 'taux_poisson' => 10.25, 'var_poids_jour' => +1, 'prix_jour' => 17],
];
?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Régimes</h1>
  <p>Gérez les régimes proposés.</p>
</div>
<div class="topbar-actions">
  <a class="btn btn-primary">Créer un nouveau régime</a>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<table>
  <tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Viande</th>
    <th>Poisson</th>
    <th>Volaille</th>
    <th>Variation de poids</th>
    <th>Prix</th>
    <th></th>
  </tr>
  <?php foreach ($regimes as $regime): ?>
    <tr>
      <td><?= esc($regime['id']) ?></td>
      <td><?= esc($regime['nom']) ?></td>
      <td><?= esc($regime['taux_viande']) ?> %</td>
      <td><?= esc($regime['taux_poisson']) ?> %</td>
      <td><?= esc($regime['taux_volaille']) ?> %</td>
      <td><?= ($regime['var_poids_jour'] > 0 ? '+' : '') . esc($regime['var_poids_jour']) ?> g/jour</td>
      <td><?= esc($regime['prix_jour']) ?> Ar/jour</td>
      <td>
        <div class="table-actions">
          <a href="<?= base_url("/backoffice/regimes/{$regime['id']}/edit") ?>" class="btn btn-other">Modifier</a>
          <button type="button" class="btn btn-danger delete-button"
                  data-nom="<?= esc($regime['nom']) ?>" data-url="<?= base_url("/backoffice/regimes/{$regime['id']}/delete") ?>">
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
    <p>Êtes-vous sûr de vouloir supprimer <strong id="nom-regime-span"></strong> ? Cette action est irréversible.</p>
    <form id="delete-form" method="post" action="<?= base_url('/backoffice/regimes/delete') ?>">
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
  const nomRegimeSpan = document.getElementById('nom-regime-span');
  deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
      const nom = this.getAttribute('data-nom');
      const url = this.getAttribute('data-url');
      deleteForm.setAttribute('action', url);
      nomRegimeSpan.textContent = nom;
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
