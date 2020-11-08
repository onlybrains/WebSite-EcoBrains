<div class="container-fluid">
  <div class="row my-2">
    <div class="col-lg-12 col-md-12">
      <p class="subtitles-coop ml-5 mr-3 mt-3 pt-2">Empresas que aceitaram negociar:</p>
    </div>
  </div>
  <!-- Topics that the Coop. are offering their services (START) -->
  <?php
  foreach ($empresas as $empresa) :
  ?>
    <div class="row my-2">
      <div class="col-lg-12 col-md-12 pb-3">
        <div class="card card-coop">
          <div class="card-body">
            <div class="container">
              <div class="row">
                <img src=<?= $empresa->banner_desc ? $empresa->banner_desc : "/imgs/image-random.png" ?> class="w-100 rounded-lg card-img-top py-2">
              </div>
              <div class="col">
                <div class="container">
                  <a href="<?= base_url('/cooperativas/empresa/' . $empresa->id_empresa); ?>" class="btn-eco efeito p-3 float-right" style="margin-top: 30px;">Ver informações para contato</a>
                </div>
                <div class="row">
                  <h5 class="card-title topic-title ml-3"><?= $empresa->nomeFantasia_dados ?></h5>
                </div>
                <div class="row ml-3">
                  <strong class="topic-desc">CNPJ: </strong>
                  <p class="topic-desc ml-2">
                    <?= substr($empresa->cnpj_dados, 0, 2) . "." . substr($empresa->cnpj_dados, 2, 3) . "." . substr($empresa->cnpj_dados, 5, 3) . "/" . substr($empresa->cnpj_dados, 8, 4) . "-" . substr($empresa->cnpj_dados, -2); ?>
                  </p>
                </div>
                <div class="row ml-3">
                  <strong class="topic-desc">Aproximadamente: </strong>
                  <p class="topic-desc ml-2"> <?= $empresa->distancematrix->distance->text ?> —
                    <i><?= $empresa->distancematrix->duration->text ?></i>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
    endforeach
      ?>
      <!-- Topics that the Coop. maybe have interest to participate (END) -->
      </div>