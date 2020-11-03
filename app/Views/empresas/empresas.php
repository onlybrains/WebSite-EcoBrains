<div class="container-fluid">
  <div class="row my-2">
    <div class="col-lg-12 col-md-12">
      <h1 class="welcome ml-5 mr-3 mt-3 pt-3">Bem-vindo, <?= $nome ?></h1>
    </div>
  </div>
  <hr />


  <div class="row my-2">
    <div class="col-md-10">
      <p class="subtitles-coop ml-5 mr-3 mt-3 pt-2">Tópicos de Negociações Ativos: </p>
    </div>
    <div class="col-md-2">
      <a href="<?= base_url('empresas/abrirtopico') ?>" class="topic-button p-1 mt-4 float-right mr-5 text-white"><svg width="40" height="30" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
        </svg> </a>
      </svg>
    </div>
  </div>

  <!-- Topics that the Coop. are offering their services (START) -->
  <?php
  foreach ($topicos as $topico) :
  ?>

    <div class="row my-2">
      <div class="col-lg-12 col-md-12 pb-3">
        <div class="card-coop">
          <div class="card-body">
            <div class="row">
              <div class="col-md-10">
                <div class="row ml-3">
                  <h5 class="card-title topic-title ml-3"><?=$topico->titulo_topico?></h5>
                </div>
                <div class="row ml-3">
                  <p class="topic-desc ml-3">Data Limite: <?php
                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');
                echo ucwords(strftime('%A, %d/%m/%Y', strtotime($topico->dataLimite_topico)));
              ?> </p>
                  <p class="topic-desc ml-3">Material: <?=$topico->nome_tpResiduo?> </p>
                  <p class="topic-desc ml-3">Peso: <?=$topico->quant_residuo?> Kg</p>
                </div>
              </div>
              <div class="col-md-2">
                <div class="row">
                <a href="<?= base_url('/empresas/topicos/'.$topico->id_topico);?>" class="topic-button p-2 mt-4 mr-4 text-white">
                    <svg width="37" height="27" viewBox="0 0 16 16" class="bi bi-list-ul" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>
                  </a>
                  <a href="<?= base_url('empresas/editartopico/'.$topico->id_topico); ?>" class="topic-button p-2 mt-4 mr-4 text-white"><svg width="37" height="27" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg> </a>
                </div>
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
<!-- Topics that the Coop. are offering their services (END) -->