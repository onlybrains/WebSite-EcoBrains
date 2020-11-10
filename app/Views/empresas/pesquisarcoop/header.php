<?php
helper('form');
?>
<div class="container-fluid pt-3">
  <div class="row my-2">
    <div class="col-lg-12 col-md-12">
      <h1 class="welcome ml-5 mr-5">Pesquisas</h1>
    </div>
  </div>
  <div class="row ml-5 mr-5">
    <div class="sign-up col-12">
      <form method="post" >
        <div class="form-row">
          <div class="form-group rounded-left col-md-9 bg-light border-right border-bottom m-0 p-2">
            <label for="kmFiltro">Distância Máxima (Km)</label>
            <input type="number" step="any" min="0" class="form-control" name="kmFiltro" id="kmFiltro" placeholder="Km" value="<?= set_value('kmFiltro') ?>"/>
          </div>
          <button type="submit" class="btn btn-green form-group col-md-3 m-0 p-2">Pesquisar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="row my-2">
    <div class="col-lg-12 col-md-12">
      <p class="subtitles-coop ml-5 mr-3 mt-3 pt-2">Resultado da pesquisa:</p>
    </div>
  </div>
  <!-- Topics that the Coop. are offering their services (START) -->
  <?php
  foreach ($cooperativas as $cooperativa) :
  ?>
    <div class="row my-2">
      <div class="col-lg-12 col-md-12 pb-3">
        <div class="card card-coop">
          <div class="card-body">
            <div class="container">
              <div class="row">
                <img src=<?= $cooperativa->banner_desc ? $cooperativa->banner_desc : "/imgs/image-random.png" ?> class="w-100 rounded-lg card-img-top py-2">
              </div>
              <div class="col">
                <div class="container">
                  <a href="<?= base_url('/empresas/coop/' . $cooperativa->id_coop); ?>" class="btn-eco efeito p-3 float-right" style="margin-top: 30px;">Ver informações para contato</a>
                </div>
                <div class="row">
                  <h5 class="card-title topic-title ml-3"><?= $cooperativa->nomeFantasia_dados ?></h5>
                </div>
                <div class="row ml-3">
                  <strong class="topic-desc">CNPJ: </strong>
                  <p class="topic-desc ml-2">
                    <?= substr($cooperativa->cnpj_dados, 0, 2) . "." . substr($cooperativa->cnpj_dados, 2, 3) . "." . substr($cooperativa->cnpj_dados, 5, 3) . "/" . substr($cooperativa->cnpj_dados, 8, 4) . "-" . substr($cooperativa->cnpj_dados, -2); ?>
                  </p>
                </div>
                <div class="row ml-3">
                  <strong class="topic-desc">Aproximadamente: </strong>
                  <p class="topic-desc ml-2"> <?= $cooperativa->distancematrix->distance->text ?> —
                    <i><?= $cooperativa->distancematrix->duration->text ?></i>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
    endforeach
      ?>
      <!-- Topics that the Coop. are offering their services (END) -->
      </div>