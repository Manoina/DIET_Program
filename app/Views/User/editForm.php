<?= $this->setVar('title', 'Modification du profil')->extend('Layout/frontoffice') ?>


<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<?php
$user = ['nom' => 'Rakoto', 'prenom' => 'Jean', 'genre' => 'M', 'email' => 'rakoto@example.com', 'taille' => '150', 'poids' => '50'];
?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Modification du profil</h1>
  <p>Modifiez vos informations.</p>
</div>
<div class="topbar-actions">
  <a href="<?= base_url('/frontoffice/profile') ?>" class="btn btn-other">Retour</a>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="content-shell">
  <form method="post" action="<?= base_url("/frontoffice/profile/edit") ?>">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="nom">Nom</label>
      <input id="nom" name="nom" type="text" value="<?= old('nom', $user['nom']) ?>" placeholder="Votre nom" required>
      <small class="error-text"><?= $errors['nom'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="prenom">Prénom</label>
      <input id="prenom" name="prenom" type="text" value="<?= old('prenom', $user['prenom']) ?>" placeholder="Votre prénom" required>
      <small class="error-text"><?= $errors['prenom'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="genre">Genre</label>
      <select name="genre">
        <option value="M" <?= old('genre', $user['genre']) == 'M' ? 'selected' : '' ?>>Homme</option>
        <option value="F" <?= old('genre', $user['genre']) == 'F' ? 'selected' : '' ?>>Femme</option>
      </select>
      <small class="error-text"><?= $errors['genre'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= old('email', $user['email']) ?>" required>
      <small class="error-text"><?= $errors['email'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="taille">Taille</label>
      <div class="input-with-suffix">
        <input id="taille" name="taille" type="number" value="<?= old('taille', $user['taille']) ?>" step="1" min="0" max="300" placeholder="150" required>
        <span class="suffix">cm</span>
      </div>
      <small class="error-text"><?= $errors['taille'] ?? '' ?></small>
    </div>

    <div class="form-group">
      <label for="poids">Poids</label>
      <div class="input-with-suffix">
        <input id="poids" name="poids" type="number" value="<?= old('poids', $user['poids']) ?>" step="0.01" min="0" max="200" placeholder="50" required>
        <span class="suffix">kg</span>
      </div>
      <small class="error-text"><?= $errors['poids'] ?? '' ?></small>
    </div>

    <button class="btn btn-primary" type="submit">Modifier le profil</button>
  </form>
</section>
<?= $this->endSection() ?>
