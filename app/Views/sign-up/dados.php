<div class="container-fluid justify-content-center">
  <div class="row">
    <div class="col my-4">
      <hr class="rounded-lg">
    </div>
  </div>
  <?php if (isset($validation)) : ?>
    <div class="row justify-content-center">
      <div class="alert alert-danger" role="alert">
        <?= $validation->listErrors() ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if (isset($msg)) : ?>
    <div class="row justify-content-center">
      <div class="alert alert-success" role="alert">
        <?= $msg ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="row justify-content-center align-items-center my-3">
    <div class="col-5 bg-light p-0 rounded-lg sign-up">
      <form method="POST">
        <div class="form-row">
          <div class="form-group col-md-5 border-right border-bottom p-2 pl-5 m-0">
            <label for="inputTipo"><b>Tipo</b></label>
            <select class="form-control border-0 bg-transparent" name="inputTipo" id="inputTipo">
              <option disabled selected></option>
              <option value="empresa">Empresa</option>
              <option value="coop">Cooperativa</option>
            </select>
          </div>
          <div class="form-group col-md-7 border-bottom p-2 pl-5 m-0">
            <label for="inputCNPJ"><b>CNPJ</b></label>
            <input type="text" class="form-control border-0 bg-transparent" name="inputCNPJ" id="inputCNPJ">
          </div>
        </div>
        <div class="form-group border-bottom p-2 pl-5 m-0">
          <label for="inputFantasia"><b>Nome Fantasia</b></label>
          <input type="text" class="form-control border-0 bg-transparent" name="inputFantasia" id="inputFantasia">
        </div>
        <div class="form-group border-bottom p-2 pl-5 m-0">
          <label for="inputRazao"><b>Razão social</b></label>
          <input type="text" class="form-control border-0 bg-transparent" name="inputRazao" id="inputRazao">
        </div>
        <div class="form-row">
          <div class="form-group col-md-4 border-right border-bottom p-2 pl-5 m-0">
            <label for="inputCEP"><b>CEP</b></label>
            <input type="text" class="form-control border-0 bg-transparent" name="inputCEP" id="inputCEP">
          </div>
          <div class="form-group col-md-4 border-right border-bottom p-2 pl-5 m-0">
            <label for="inputNumEnd"><b>Número</b></label>
            <input type="number" class="form-control border-0 bg-transparent" name="inputNumEnd" id="inputNumEnd" min="0" max="99999">
          </div>
          <div class="form-group col-md-4 border-bottom p-2 pl-5 m-0">
            <label for="inputComplemento"><b>Complemento</b></label>
            <input type="text" class="form-control border-0 bg-transparent" name="inputComplemento" id="inputComplemento">
          </div>
        </div>
        <div class="form-group border-right border-bottom p-2 pl-5 m-0">
          <label for="inputEnd"><b>Endereço</b></label>
          <input type="text" class="form-control border-0 bg-transparent" name="inputEnd" id="inputEnd" readonly>
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