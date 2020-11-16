<div class="container-fluid justify-content-center">
  <div class="row">
    <div class="col my-4">
      <hr class="rounded-lg">
    </div>
  </div>
  <?php if (!empty($errors)) : ?>
    <div class="row justify-content-center">
      <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $field => $error) : ?>
          <p><?= $error ?></p>
        <?php endforeach ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="row justify-content-center align-items-center my-3">
    <div class="col-5 bg-light p-0 rounded-lg sign-up">
      <form method="POST">
        <div class="form-row">
          <div class="form-group col-md-5 border-right border-bottom p-2 pl-4 pr-4 m-0">
            <label for="inputTipo">Tipo</label>
            <select class="form-control border-0 bg-transparent" name="inputTipo" id="inputTipo">
              <option disabled selected <?= set_select('inputTipo') ?>></option>
              <option value="empresa" <?= set_select('inputTipo', 'empresa') ?>>Empresa</option>
              <option value="coop" <?= set_select('inputTipo', 'coop') ?>>Cooperativa</option>
            </select>
          </div>
          <div class="form-group col-md-7 border-bottom p-2 pl-4 pr-4 m-0">
            <label for="inputCNPJ">CNPJ</label>
            <input type="text" class="form-control border-0" name="inputCNPJ" id="inputCNPJ" value="<?= set_value('inputCNPJ') ?>">
          </div>
        </div>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="inputFantasia">Nome Fantasia</label>
          <input type="text" class="form-control border-0" name="inputFantasia" id="inputFantasia" value="<?= set_value('inputFantasia') ?>">
        </div>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="inputRazao">Razão social</label>
          <input type="text" class="form-control border-0" name="inputRazao" id="inputRazao" value="<?= set_value('inputRazao') ?>">
        </div>
        <div class="form-row">
          <div class="form-group col-md-4 border-right border-bottom p-2 pl-4 pr-4 m-0">
            <label for="inputCEP">CEP</label>
            <input type="text" class="form-control border-0" name="inputCEP" id="inputCEP" value="<?= set_value('inputCEP') ?>">
          </div>
          <div class="form-group col-md-4 border-right border-bottom p-2 pl-4 pr-4 m-0">
            <label for="inputNumEnd">Número</label>
            <input type="number" class="form-control border-0" name="inputNumEnd" id="inputNumEnd" min="0" max="99999" value="<?= set_value('inputNumEnd') ?>">
          </div>
          <div class="form-group col-md-4 border-bottom p-2 pl-4 pr-4 m-0">
            <label for="inputComplemento">Complemento</label>
            <input type="text" class="form-control border-0" name="inputComplemento" id="inputComplemento" value="<?= set_value('inputComplemento') ?>">
          </div>
        </div>
        <div class="form-group border-right border-bottom p-2 pl-4 pr-4 m-0">
          <label for="inputEnd">Endereço</label>
          <input type="text" class="form-control border-0" name="inputEnd" id="inputEnd" readonly value="<?= set_value('inputEnd') ?>">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6 border-right border-bottom p-2 pl-4 pr-4 m-0">
            <label for="inputTel">Telefone</label>
            <input type="text" class="form-control border-0" name="inputTel" id="inputTel" value="<?= set_value('inputTel') ?>">
          </div>
          <div class="form-group col-md-6 border-bottom p-2 pl-4 pr-4 m-0">
            <label for="inputWhats">WhatsApp</label>
            <input type="text" class="form-control border-0" name="inputWhats" id="inputWhats" value="<?= set_value('inputWhats') ?>">
          </div>
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