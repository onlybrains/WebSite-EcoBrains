<?php if (!empty($errors)) : ?>
  <div class="alert alert-danger" role="alert">
    <?php foreach ($errors as $error) : ?>
      <p><?= esc($error) ?></p>
    <?php endforeach ?>
  </div>
<?php endif ?>