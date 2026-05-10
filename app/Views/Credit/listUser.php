<?= $this->setVar('title', 'Crédits')->extend('Layout/backoffice') ?>


<?php
$credits = [
  ['date_demande' => '2026-05-09', 'code' => '41873948752687', 'valeur' => 10000, 'est_accepte' => true],
  ['date_demande' => '2026-05-09', 'code' => '41873948752687', 'valeur' => 20000, 'est_accepte' => null],
  ['date_demande' => '2026-05-09', 'code' => '41873948752687', 'valeur' => 5000, 'est_accepte' => false],
  ['date_demande' => '2026-05-09', 'code' => '41873948752687', 'valeur' => 2000, 'est_accepte' => null],
  ['date_demande' => '2026-05-09', 'code' => '41873948752687', 'valeur' => 10000, 'est_accepte' => null],
];
?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Crédits</h1>
  <p>Rentrez des crédits.</p>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<form method="post" action="<?= base_url('/frontoffice/credits/use') ?>" class="content-shell">
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
  <?php foreach ($credits as $credit): ?>
    <tr>
      <td><?= esc($credit['date_demande']) ?></td>
      <td><?= esc($credit['code']) ?></td>
      <td><?= esc($credit['valeur']) ?> Ar</td>
      <td>
        <?php if ($credit['est_accepte'] === null): ?>
          <span class="badge badge-pending">EN ATTENTE</span>
        <?php elseif ($credit['est_accepte'] === false): ?>
          <span class="badge badge-refused">REFUSÉ</span>
        <?php else: ?>
          <span class="badge badge-accepted">ACCEPTÉ</span>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
<?= $this->endSection() ?>
