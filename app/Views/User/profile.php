<?= $this->setVar('title', 'Profil')->extend('Layout/frontoffice') ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Mon profil</h1>
  <p>Vérifiez vos informations.</p>
</div>
<div class="topbar-actions">
  <a href="<?= base_url('/frontoffice/profil/modifier') ?>" class="btn btn-primary">Modifier le profil</a>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="content-shell">
  <div class="profile-hero">
    <img class="profile-avatar" src="<?= base_url('/assets/images/avatar-user.jpg') ?>">
    <div>
      <h2><?= esc($user['nom']) ?></h2>
      <p><?= esc($user['email']) ?></p>
    </div>
  </div>
</section>

<div class="flex-row">
  <section class="content-shell flex-grow">
    <h3>Informations personnelles</h3>
    <dl class="details-list">
      <div>
        <dt>Nom</dt>
        <dd><?= esc($user['nom']) ?></dd>
      </div>
      <div>
        <dt>Genre</dt>
        <dd><?= $user['genre'] == 'M' ? 'Homme' : 'Femme' ?></dd>
      </div>
      <div>
        <dt>Email</dt>
        <dd><?= esc($user['email']) ?></dd>
      </div>
    </dl>
  </section>

  <section class="content-shell flex-grow">
    <h3>Informations de santé</h3>
    <dl class="details-list">
      <div>
        <dt>Taille</dt>
        <dd><?= esc($user['taille']) ?> cm</dd>
      </div>
      <div>
        <dt>Poids</dt>
        <dd><?= esc($user['poids']) ?> kg</dd>
      </div>
      <div>
        <dt>IMC</dt>
        <dd><?= esc($imc) ?></dd>
      </div>
    </dl>
  </section>
</div>
<?= $this->endSection() ?>
