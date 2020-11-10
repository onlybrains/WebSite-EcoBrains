<div class="container">

  <div class="row mt-5">
    <div class="col-md-9">
      <h1><?= $registroEmpresa->titulo_topico ?></h1>
    </div>

    <div class="col-md-3">
      <div class="row">
        <a href="<?= base_url('/empresas/editartopico/' . $registroEmpresa->id_topico) ?>" class="topic-button btn p-2 mt-2 mr-2 text-white">
          Editar Tópico
        </a>
        <a href="<?= base_url('/empresas/deletartopico/' . $registroEmpresa->id_topico) ?>" class="topic-button btn p-2 mt-2 mr-4 text-white">
          Excluir Tópico</a>
      </div>
    </div>


  </div>

  <div class="row mt-3 mb-4">
    <div class="rounded-lg sign-up col-12 bg-light">
      <form>
        <div class="form-row">
          <div class="form-group col-md-4 border-right border-bottom m-0 p-2">
            <label for="nome_tpResiduo">Tipo de Resíduo</label>
            <input class="form-control" type="text" readonly value="<?= $registroEmpresa->nome_tpResiduo ?>">
          </div>
          <div class="form-group col-md-4 border-right border-bottom m-0 p-2">
            <label for="quant_residuo">Quantidade de resíduos</label>
            <input class="form-control" type="text" readonly value="<?= $registroEmpresa->quant_residuo ?> Kg">
          </div>
          <div class="form-group col-md-4 border-bottom m-0 p-2">
            <label for="dataLimite_topico">Data Limite:</label>
            <input class="form-control" type="text" readonly value="<?php echo date('d/m/Y', strtotime(($registroEmpresa->dataLimite_topico))); ?>">
      </form>
    </div>


    <!--Init Cards-->

    <div class="col-lg-12 col-md-12 pb-3 mt-4">

      <h4>Cooperativas Interessadas:</h4>
      <?php
      foreach ($registrosInteresseCooperativa as $registro) :
      ?>
        <div class="card-coop border">
          <div class="card-body">
            <div class="row">
              <div class="col-md-7">
                <div class="row ml-2 mt-2">
                  <h5 class="card-title topic-title ml-3"><?= $registro->nomeFantasia_dados ?></h5>
                </div>
                <div class="row ml-2">
                  <p class="topic-desc ml-3">CNPJ da Cooperativa:
                    <?= substr($registro->cnpj_dados, 0, 2) . "." . substr($registro->cnpj_dados, 2, 3) . "." . substr($registro->cnpj_dados, 5, 3) . "/" . substr($registro->cnpj_dados, 8, 4) . "-" . substr($registro->cnpj_dados, -2); ?>
                  </p>
                </div>
              </div>
              <div class="col-md-5">
                <div class="row">
                  <a href=<?= base_url('empresas/coop/' . $registro->id_coop) ?> class="topic-button btn p-2 mt-4 mr-4 text-white">
                    Conheça a Cooperativa
                  </a>
                  <a href="<?= base_url('empresas/aprovar/' . $registro->id_topico . '/' . $registro->id_coop); ?>" class="topic-button p-2 mt-4 mr-4 text-white"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                    </svg></a>
                  <a href="<?= base_url('empresas/negar/' . $registro->id_topico . '/' . $registro->id_coop); ?>" class="topic-button p-2 mt-4 mr-4 text-white"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg></a>
                </div>
              </div>
            </div>

          </div>
        </div>
        <br />
      <?php
      endforeach;
      ?>
    </div>

    <!--End Cards-->

  </div>