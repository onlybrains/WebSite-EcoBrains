<?php
helper('form');
?>
<div class="container-fluid my-4">
  <div class="row justify-content-center my-2">
    <div class="col-11">
      <h1 class="welcome">Pesquisas</h1>
    </div>
  </div>
  <div class="row justify-content-center mb-5">
    <div class="sign-up col-11">
      <form method="post">
        <div class="form-row">
          <div class="form-group rounded-left col-md-9 bg-light border-right border-bottom m-0 p-2">
            <label for="kmFiltro">Distância Máxima (Km)</label>
            <input type="number" step="any" min="0" class="form-control" name="kmFiltro" id="kmFiltro" placeholder="Km" value="<?= set_value('kmFiltro') ?>" />
          </div>
          <button type="submit" class="btn btn-green form-group col-md-3 m-0 p-2">Pesquisar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="row justify-content-center my-2">
    <div class="col-11">
      <p class="subtitles-coop ">Resultado da pesquisa:</p>
    </div>
  </div>
  <!-- Topics that the Coop. are offering their services (START) -->
  <?php
  foreach ($cooperativas as $cooperativa) :
  ?>
    <div class="row justify-content-center">
      <div class="col-11">
        <div class="card card-coop">
          <div class="row card-body mb-2">
            <div class="col-12">
              <img src=<?= file_exists($cooperativa->banner_desc) ? base_url($cooperativa->banner_desc) : "/imgs/image-random.png" ?> class="w-100 rounded-lg card-img-top py-2">
            </div>
            <div class="col-md-6">
              <div class="col-11 container">
                <h5 class="card-title topic-title"><?= $cooperativa->nomeFantasia_dados ?></h5>
                <p class="topic-desc">
                  <strong class="topic-desc">CNPJ: </strong>
                  <?= substr($cooperativa->cnpj_dados, 0, 2) . "." . substr($cooperativa->cnpj_dados, 2, 3) . "." . substr($cooperativa->cnpj_dados, 5, 3) . "/" . substr($cooperativa->cnpj_dados, 8, 4) . "-" . substr($cooperativa->cnpj_dados, -2); ?>
                </p>
                <p class="topic-desc">
                  <strong class="topic-desc">Aproximadamente: </strong>
                  <?= $cooperativa->distancematrix->distance->text ?> —
                  <i><?= $cooperativa->distancematrix->duration->text ?></i>
                </p>
              </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <div class="col-11 container">
                <a href="<?= base_url('/empresas/coop/' . $cooperativa->id_coop); ?>" class="btn-eco efeito p-3 float-left">Ver informações para contato</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  endforeach
  ?>
</div>