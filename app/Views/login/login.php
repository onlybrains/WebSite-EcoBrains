<div class="container-fluid justify-content-center">
  <div class="row">
    <div class="col my-4">
      <hr class="rounded-lg">
    </div>
  </div>
  <?php if (!empty($errors)) : ?>
    <div class="row justify-content-center mx-1">
      <?= $errors->listErrors('my-list') ?>
    </div>
  <?php endif; ?>
  <div class="row justify-content-center align-items-center my-3">
    <div class="col-md-6 col-11 bg-light p-0 rounded-lg sign-up">
      <form method="POST">
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="inputUser">Usuário</label>
          <input type="text" class="form-control" name="inputUser" id="inputUser" value=<?= set_value('inputUser') ?>>
        </div>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="inputPassword">Senha</label>
          <input type="password" class="form-control" name="inputPassword" id="inputPassword" value=<?= set_value('inputPassword') ?>>
        </div>
        <div class="d-flex">
          <button type="submit" class="btn btn-green flex-fill p-3">Confirmar</button>
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