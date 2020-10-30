<div class="container">

  <div class="text-center mt-5">
    <h2>Abertura de Tópico de Negociação</h2>
  </div>

  <div class="row justify-content-center align-items-center my-5">
    <div class="col-8 bg-light p-0 rounded-lg sign-up">
      <form method="post">
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="titulo_topico">Título do Tópico</label>
          <input type="text" class="form-control border-0" name="titulo_topico" id="titulo_topico" placeholder="Tópico de Negociação 1">
        </div>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="tipoResiduos">Tipo de Resíduo:</label>
          <select class="form-control " name="tipoResiduos" id="tipoResiduos">
            <?php
            foreach ($tpResiduos as $residuo) :
            ?>
              <option value="<?= $residuo->id_tpResiduo ?>">
                <?= $residuo->nome_tpResiduo ?>
              </option>
            <?php
            endforeach
            ?>
          </select>
        </div>
        <div class="form-group border-bottom p-2 pl-4 pr-4 m-0">
          <label for="quant_residuo">Peso</label>
          <input type="text" class="form-control border-0" name="quant_residuo" id="quant_residuo" placeholder="25Kg">
        </div>
        <div class="form-group p-2 pl-4 pr-4 m-0">
          <label for="dataLimite_topico">Data Limite</label>
          <input type="date" class="form-control border-0" name="dataLimite_topico" id="dataLimite_topico">
        </div>
        <div class="d-flex">
          <button type="submit" class="btn btn-green flex-fill p-3">Abrir Tópico</button>
        </div>
      </form>
    </div>
  </div>

</div>
