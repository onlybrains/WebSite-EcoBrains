<div class="container-fluid justify-content-center">
  <div class="row">
    <div class="col my-4">
      <hr class="rounded-lg">
    </div>
  </div>
  <?php if (!empty($errors)) : ?>
    <div class="row justify-content-center">
      <?= $errors->listErrors('my-list') ?>
    </div>
  <?php endif; ?>
  <div class="row justify-content-center align-items-center my-3">
    <div class="col-5 bg-light p-0 rounded-lg sign-up">
      <form method="POST">
        <div class="form-group border-bottom p-2 pl-5 m-0">
          <label for="inputUser"><b>Usuário</b></label>
          <input type="text" class="form-control border-0 bg-transparent" name="inputUser" id="inputUser" value=<?= set_value('inputUser') ?>>
        </div>
        <div class="form-group border-bottom p-2 pl-5 m-0">
          <label for="inputPassword"><b>Senha</b></label>
          <input type="password" class="form-control border-0 bg-transparent" name="inputPassword" id="inputPassword" value=<?= set_value('inputPassword') ?>>
        </div>
        <div class="d-flex">
          <button type="submit" class="btn btn-green flex-fill p-3"><b>Confirmar</b></button>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col my-4">
      <hr>
    </div>
  </div>
</div>