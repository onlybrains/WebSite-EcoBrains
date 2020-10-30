<div class="container">

  <div class="text-center mt-5">
    <h2>Editar Tópico de Negociação</h2>
  </div>
  <?php
  foreach ($dados as $dado) :
    foreach ($dadosResiduos as $dador) :
  ?>
      <div class="row justify-content-center align-items-center my-5">
        <div class="col-8 bg-light p-0 rounded-lg sign-up">
          <form method='post'>
            <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">

              <label for="titulo_topico">Título do Tópico</label>
              <input type="text" class="form-control" name="titulo_topico" id="titulo_topico" value="<?php echo ($dado->titulo_topico); ?>">

            </div>
            <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
              <label for="id_tpResiduo">Material</label>
              <select class="form-control " name="id_tpResiduo" id="id_tpResiduo">
                <?php
                foreach ($tpResiduos as $residuo) :
                ?>
                  <option value="<?= $dador->id_tpResiduo ?>">
                    <?= $residuo->nome_tpResiduo ?>
                  </option>
                <?php
                endforeach
                ?>
              </select>

            </div>
            <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
              <label for="quant_residuo">Peso</label>
              <input type="text" class="form-control" name="quant_residuo" id="quant_residuo" value="<?php echo ($dador->quant_residuo); ?>">
            </div>
            <div class="form-group p-2 pl-4 pr-4 m-0">
              <label for="dataLimite_topico">Data Limite</label>
              <input type="text" class="form-control" name="dataLimite_topico" id="dataLimite_topico" value="<?php echo date('d/m/Y', strtotime(($dado->dataLimite_topico))); ?>">
            </div>
            <div class="d-flex">
              <button type="submit" class="btn btn-green flex-fill p-3">Salvar Alterações</button>
            </div>
          </form>
        </div>
      </div>

  <?php
    endforeach;
  endforeach;
  ?>

</div>