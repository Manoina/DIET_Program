<?= $this->setVar('title', 'Tableau de bord')->extend('Layout/backoffice') ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Tableau de bord</h1>
  <p>Ayez une vue d’ensemble sur le système.</p>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="flex-row">
  <section class="content-shell flex-grow" style="flex-basis: 50%;">
    <h3 style="">Achat de crédits</h3>
    <div>
      <canvas id="credit-chart"></canvas>
    </div>
  </section>

  <section class="content-shell flex-grow" style="flex-basis: 50%;">
    <h3>Achat de l’option GOLD</h3>
    <div>
      <canvas id="gold-chart"></canvas>
    </div>
  </section>
</div>

<table>
  <tr>
    <th></th>
    <th>Perte de poids</th>
    <th>Gain de poids</th>
    <th>IMC idéal</th>
  </tr>
  <tr>
    <th>Homme</th>
    <td><?= esc($goalCounts['reduire']['M'] ?? 0) ?></td>
    <td><?= esc($goalCounts['augmenter']['M'] ?? 0) ?></td>
    <td><?= esc($goalCounts['imc']['M'] ?? 0) ?></td>
  </tr>
  <tr>
    <th>Femme</th>
    <td><?= esc($goalCounts['reduire']['F'] ?? 0) ?></td>
    <td><?= esc($goalCounts['augmenter']['F'] ?? 0) ?></td>
    <td><?= esc($goalCounts['imc']['F'] ?? 0) ?></td>
  </tr>
</table>

<script src="<?= base_url('/assets/js/chart.umd.min.js') ?>"></script>

<script>
  const creditChart = document.getElementById('credit-chart');
  const goldChart = document.getElementById('gold-chart');

  const creditLabels = <?= json_encode($creditChartLabels) ?>;
  const creditData = <?= json_encode($creditChartData) ?>;
  const goldLabels = <?= json_encode($goldChartLabels) ?>;
  const goldData = <?= json_encode($goldChartData) ?>;

  new Chart(creditChart, {
    type: 'line',
    data: {
      labels: creditLabels,
      datasets: [{
        label: 'Achat de crédit',
        data: creditData,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  new Chart(goldChart, {
    type: 'line',
    data: {
      labels: goldLabels,
      datasets: [{
        label: 'Achat de l’option GOLD',
        data: goldData,
        fill: false,
        borderColor: 'rgb(255, 159, 64)',
        tension: 0.1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<?= $this->endSection() ?>
