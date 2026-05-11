<?php
$title = $title ?? 'Accueil';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIET | <?= $title ?></title>
  <link rel="stylesheet" href="<?= base_url('/assets/css/global.css') ?>">
</head>
<body class="landing-body">
  <main class="landing-page">
    <section class="landing-shell">
      <div class="landing-hero">
        <span class="landing-kicker">DIET</span>
        <h1>Des régimes et activités sportives adaptés à votre objectif.</h1>
        <p>
          Vous n’êtes pas heureux dans votre corps ? Ne vous inquiétez plus, nous sommes là pour
          vous proposer le programme qui vous correspond le mieux.
        </p>
        <div class="landing-actions">
          <a class="btn btn-other" href="<?= base_url('/frontoffice/login') ?>">Se connecter</a>
          <a class="btn btn-primary" href="<?= base_url('/frontoffice/signup') ?>">S’inscrire</a>
        </div>
        <div class="landing-tags">
          <span class="landing-tag">Régimes</span>
          <span class="landing-tag">Activités sportives</span>
          <span class="landing-tag">IMC idéal</span>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
