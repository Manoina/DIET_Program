<?= $this->setVar('title', 'Crédits')->extend('Layout/frontoffice') ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Crédits</h1>
  <p>Rentrez des crédits.</p>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<form method="post" action="<?= base_url('/frontoffice/credit/demander') ?>" class="content-shell">
  <?= csrf_field() ?>

  <div class="form-group">
    <label for="code">Code de crédit</label>
    <input type="text" id="code" name="code" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Ajouter un crédit</button>
</form>

<table>
  <tr>
    <th>Date</th>
    <th>Code</th>
    <th>Valeur</th>
    <th></th>
  </tr>
  <?php foreach ($demandes as $demande): ?>
    <tr>
      <td><?= esc($demande['date_demande']) ?></td>
      <td><?= esc($demande['code']) ?></td>
      <td><?= esc($demande['valeur']) ?> Ar</td>
      <td>
        <?php if ($demande['est_accepte'] === null): ?>
          <span class="badge badge-pending">EN ATTENTE</span>
        <?php elseif ($demande['est_accepte'] === false): ?>
          <span class="badge badge-refused">REFUSÉ</span>
        <?php else: ?>
          <span class="badge badge-accepted">ACCEPTÉ</span>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
<?= $this->endSection() ?>
