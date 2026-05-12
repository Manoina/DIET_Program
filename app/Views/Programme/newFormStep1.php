<?= $this->setVar('title', 'Nouveau programme')->extend('Layout/frontoffice') ?>


<?= $this->section('topbar') ?>
<div class="page-title">
  <h1>Nouveau programme</h1>
  <p>Planifiez votre régime et vos activités sportives.</p>
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<form method="post" action="<?= base_url('/frontoffice/programmes/new') ?>" class="content-shell">
  <?= csrf_field() ?>

  <div class="form-group">
    <label for="objectif">Quel est votre objectif ?</label>
    <select type="text" id="objectif" name="objectif">
      <option value="augmenter">Augmenter mon poids</option>
      <option value="reduire">Réduire mon poids</option>
      <option value="imc">Atteindre mon IMC idéal</option>
    </select>
  </div>

  <div class="form-group" id="poids-group">
    <label for="poids">Combien de poids voulez-vous perdre ?</label>
    <div class="input-with-suffix">
      <input id="poids" name="poids" type="number" value="<?= old('poids', 10) ?>" step="0.01" min="0.01" required>
      <span class="suffix">kg</span>
    </div>
    <small class="error-text"><?= $errors['poids'] ?? '' ?></small>
  </div>

  <div class="form-group">
    <label for="duree_semaine">En combien de semaines ?</label>
    <div class="input-with-suffix">
      <input id="duree_semaine" name="duree_semaine" type="number" value="<?= old('duree_semaine', 4) ?>" step="1" min="1" required>
      <span class="suffix">semaines</span>
    </div>
    <small class="error-text"><?= $errors['duree_semaine'] ?? '' ?></small>
  </div>

  <div class="form-group">
    <label>Quelles activités sportives vous conviennent ?</label>
    <div>
      <?php foreach ($sports as $sport): ?>
        <label>
          <input type="checkbox" name="activites[]" value="<?= $sport['id'] ?>" <?= in_array($sport['id'], old('activites', [])) ? 'checked' : '' ?>>
          <span><?= $sport['nom'] ?></span>
        </label>
      <?php endforeach; ?>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Suivant</button>
</form>

<script>
  const objectifSelect = document.getElementById('objectif');
  const poidsGroup = document.getElementById('poids-group');
  const poidsInput = document.getElementById('poids');
  const poidsLabel = poidsGroup.querySelector('label');

  function togglePoidsGroup() {
    if (objectifSelect.value === 'imc') {
      poidsGroup.style.display = 'none';
      poidsInput.removeAttribute('required');
    }
    else {
      poidsGroup.style.display = 'block';
      poidsInput.setAttribute('required', 'required');
      if (objectifSelect.value === 'augmenter') {
        poidsLabel.textContent = 'Combien de poids voulez-vous gagner ?';
      }
      else {
        poidsLabel.textContent = 'Combien de poids voulez-vous perdre ?';
      }
    }
  }

  objectifSelect.addEventListener('change', togglePoidsGroup);
  togglePoidsGroup();
</script>
<?= $this->endSection() ?>
