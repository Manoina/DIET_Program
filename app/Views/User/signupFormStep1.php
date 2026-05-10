<?= $this->setVar('title', 'Inscription')->extend('Layout/modal') ?>


<?php $errors = session()->getFlashdata('errors') ?? [] ?>

<?php
$user = ['nom' => '', 'prenom' => '', 'genre' => 'M', 'email' => '', 'password' => ''];
?>


<?= $this->section('content') ?>
<h1 class="form-title">Inscription</h1>
<form action="<?= base_url('/frontoffice/signup') ?>" method="post">
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
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" value="<?= old('password', $user['password']) ?>" required>
    <small class="error-text"><?= $errors['password'] ?? '' ?></small>
  </div>

  <button type="submit" class="btn btn-primary">Suivant</button>

  <hr>
  <p>Vous avez déjà un compte ?</p>
  <a href="<?= base_url('/frontoffice/login') ?>" class="btn btn-other">Se connecter</a>
</form>
<?= $this->endSection() ?>
