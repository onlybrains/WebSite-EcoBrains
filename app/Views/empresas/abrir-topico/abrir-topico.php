<?php
helper('form');
?>
<div class="container">

  <div class="text-center mt-5">
    <h2>Abertura de Tópico de Negociação</h2>
  </div>
  <div class="row justify-content-center align-items-center my-5">
    <?php if (!empty($errors)) : ?>
      <div class="row justify-content-center mx-1">
        <div class="alert alert-danger" role="alert">
          <?php foreach ($errors as $field => $error) : ?>
            <p><?= $error ?></p>
          <?php endforeach ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="col-md-8 col-11 bg-light p-0 rounded-lg sign-up">
      <form method="post">
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="titulo_topico">Título do Tópico</label>
          <input type="text" class="form-control " name="titulo_topico" id="titulo_topico" placeholder="Tópico de Negociação 1" value="<?= set_value('titulo_topico') ?>">
        </div>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="id_tpResiduo">Tipo de Resíduo:</label>
          <select class="form-control " name="id_tpResiduo" id="id_tpResiduo" value="<?= set_value('id_tpResiduo') ?>">
            <option selected disabled>
              <?php
              foreach ($tpResiduos as $residuo) :
              ?>
            <option value="<?= $residuo->id_tpResiduo ?>" <?= set_select('id_tpResiduo', $residuo->id_tpResiduo) ?>>
              <?= $residuo->nome_tpResiduo ?>
            </option>

          <?php
              endforeach
          ?>
          </select>
        </div>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="quant_residuo">Peso (Kg)</label>
          <input type="text" class="form-control " name="quant_residuo" id="quant_residuo" placeholder="25Kg" value="<?= set_value('quant_residuo') ?>">
        </div>
        <div class="form-group p-2 pl-4 pr-4 m-0">
          <label for="dataLimite_topico">Data Limite</label>
          <input type="date" class="form-control " name="dataLimite_topico" id="dataLimite_topico" value="<?= set_value('dataLimite_topico') ?>">
        </div>
        <div class="d-flex">
          <button type="submit" class="btn btn-green flex-fill p-3">Abrir Tópico</button>
        </div>
      </form>
    </div>
  </div>

</div>