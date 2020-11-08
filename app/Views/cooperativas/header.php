<div class="container-fluid">
  <div class="row my-2">
    <div class="col-lg-12 col-md-12">
      <h1 class="welcome ml-5 mr-3 mt-3 pt-5">Bem-vindo, <?= $nome ?></h1>
    </div>
    <div class="col-lg-12 col-md-12">
      <p class="subtitles-coop ml-5 mr-3 mt-3 pt-2">Tópicos de Negociação que você participa:</p>
    </div>
  </div>
  <!-- Topics that the Coop. are offering their services (START) -->
  <?php
  foreach ($topicos as $topico) :
  ?>
    <div class="row my-2">
      <div class="col-lg-12 col-md-12 pb-3">
        <div class="card-coop">
          <div class="card-body m-2">
            <!-- <a href="#" class="topic-button p-2 mt-4 float-right"><img src="imgs/topics-vector.png" width="37" height="25"> </a> -->
            <div class="row">
              <h5 class="card-title topic-title ml-3"><?= $topico->titulo_topico ?></h5>
            </div>
            <div class="row">
              <p class="topic-desc ml-3">Data Limite:
                <?php
                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');
                echo ucwords(strftime('%A, %d/%m/%Y', strtotime($topico->dataLimite_topico)));
                ?>
              </p>
              <p class="topic-desc ml-3">Material: <?= $topico->nome_tpResiduo ?> </p>
              <p class="topic-desc ml-3">Peso: <?= $topico->quant_residuo ?> Kg</p>
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