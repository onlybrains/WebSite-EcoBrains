<div class="container-fluid">
  <div class="row my-2 justify-content-center">
    <div class="col-11">
      <p class="subtitles-coop mt-3 pt-2">Empresas que aceitaram negociar:</p>
    </div>
  </div>
  <!-- Topics that the Coop. are offering their services (START) -->
  <?php
  foreach ($empresas as $empresa) :
  ?>
    <div class="row my-4">
      <div class="col">
        <div class="card card-coop">
          <div class="row card-body mb-2">
            <div class="col-12">
              <img src=<?= file_exists($empresa->banner_desc) ? base_url($empresa->banner_desc) : "/imgs/image-random.png" ?> class="w-100 rounded-lg card-img-top py-2">
            </div>
            <div class="col-md-6">
              <div class="col-11 container">
                <h5 class="card-title topic-title"><?= $empresa->nomeFantasia_dados ?></h5>
                <p class="topic-desc">
                  <strong class="topic-desc">CNPJ: </strong>
                  <?= substr($empresa->cnpj_dados, 0, 2) . "." . substr($empresa->cnpj_dados, 2, 3) . "." . substr($empresa->cnpj_dados, 5, 3) . "/" . substr($empresa->cnpj_dados, 8, 4) . "-" . substr($empresa->cnpj_dados, -2); ?>
                </p>
                <p class="topic-desc">
                  <strong class="topic-desc">Aproximadamente: </strong>
                  <?= $empresa->distancematrix->distance->text ?> —
                  <i><?= $empresa->distancematrix->duration->text ?></i>
                </p>
              </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <div class="col-11 container">
                <a href="<?= base_url('/cooperativas/empresa/' . $empresa->id_empresa); ?>" class="btn-eco efeito p-3 float-left">Ver informações para contato</a>
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