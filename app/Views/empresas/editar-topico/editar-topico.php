<div class="container">

  <div class="text-center mt-5">
    <h2>Editar Tópico de Negociação</h2>
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
      <form method='post'>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">

          <label for="titulo_topico">Título do Tópico</label>
          <input type="text" class="form-control" name="titulo_topico" id="titulo_topico" value="<?php echo ($topicos->titulo_topico); ?>">
          <small class="form-text text-muted">
            <?php echo ($topicos->titulo_topico); ?>
          </small>

        </div>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="id_tpResiduo">Material</label>
          <select class="form-control " name="id_tpResiduo" id="id_tpResiduo">
            <?php
            foreach ($tpResiduos as $residuo) :
              if ($topicos->id_tpResiduo === $residuo->id_tpResiduo)
                $selectedTpResiduo = "selected";
              else
                $selectedTpResiduo = "";
            ?>
              <option <?= $selectedTpResiduo ?> value="<?= $residuo->id_tpResiduo ?>">
                <?= $residuo->nome_tpResiduo ?>
              </option>
            <?php
            endforeach
            ?>
          </select>
          <small class="form-text text-muted">
            <?= $topicos->nome_tpResiduo ?>
          </small>
        </div>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="quant_residuo">Peso (Kg)</label>
          <input type="text" class="form-control" name="quant_residuo" id="quant_residuo" value="<?php echo ($topicos->quant_residuo); ?>">
          <small class="form-text text-muted">
            <?= $topicos->quant_residuo ?> Kg
          </small>
        </div>

        <div class="form-group p-2 pl-4 pr-4 m-0">
          <label for="dataLimite_topico">Data Limite</label>
          <input type="date" class="form-control" name="dataLimite_topico" id="dataLimite_topico" value="<?php echo date('Y-m-d', strtotime(($topicos->dataLimite_topico))); ?>">
          <small class="form-text text-muted">
            <?= date('d/m/Y', strtotime(($topicos->dataLimite_topico))); ?>
          </small>
        </div>
        <div class="d-flex">
          <button type="submit" class="btn btn-green flex-fill p-3">Salvar Alterações</button>
        </div>
      </form>
    </div>
  </div>
</div>