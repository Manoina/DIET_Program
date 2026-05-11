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
    <td>123</td>
    <td>123</td>
    <td>123</td>
  </tr>
  <tr>
    <th>Femme</th>
    <td>123</td>
    <td>123</td>
    <td>123</td>
  </tr>
</table>

<script src="<?= base_url('/assets/js/chart.umd.min.js') ?>"></script>

<script>
  const creditChart = document.getElementById('credit-chart');
  const goldChart = document.getElementById('gold-chart');

  new Chart(creditChart, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
          label: 'Achat de crédit',
        data: [65, 59, 80, 81, 56, 55, 40],
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
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Achat de l’option GOLD',
        data: [65, 59, 80, 81, 56, 55, 40],
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
</script>
<?= $this->endSection() ?>
