<div class="container-fluid pt-3">
  <div class="row my-2">
    <div class="col-lg-12 col-md-12">
      <h1 class="welcome ml-5 mr-5">Pesquisas</h1>
    </div>
  </div>
  <div class="row ml-5 mr-5">
    <div class="sign-up col-12">
      <form method="POST" action="pesquisafiltro">
        <div class="form-row">
          <div class="form-group rounded-left col-md-3 bg-light border-right border-bottom m-0 p-2">
            <label for="tpResiduo">Tipo de Resíduo</label>
            <select class="form-control" name="tpResiduoFiltro" id="tpResiduoFiltro" required>
              <option disabled selected>Selecione o resíduo</option>
              <?php
              foreach ($tipos as $tipo) :
              ?>
                <option><?= $tipo->nome_tpResiduo ?></option>
              <?php
              endforeach
              ?>
            </select>
          </div>
          <div class="form-group bg-light col-md-3 border-right border-bottom m-0 p-2">
            <label for="inputUser">Data Limite</label>
            <input type="date" class="form-control" name="dataLimiteFiltro" id="dataLimiteFiltro" value="<?= date('Y-m-d'); ?>" required>
          </div>
          <div class="form-group bg-light col-md-3 border-bottom m-0 p-2">
            <label for="inputUser">Peso</label>
            <input type="number" class="form-control" name="pesoFiltro" id="pesoFiltro" placeholder="Até..." required />
          </div>
          <button type="submit" class="btn btn-green form-group col-md-3 m-0 p-2">Pesquisar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="row my-2 justify-content-center">
    <div class="col-11">
      <p class="subtitles-coop mt-3 pt-2">Resultado da pesquisa:</p>
    </div>
  </div>
  <!-- Topics that the Coop. are offering their services (START) -->
  <?php
  foreach ($topicos as $topico) :
  ?>
    <div class="row my-2 justify-content-center">
      <div class="col-11">
        <div class="card card-coop">
          <div class="card-body p-2">
            <div class="row m-1">
              <img src=<?= file_exists($topico->banner_desc) ? base_url($topico->banner_desc) : "/imgs/image-random.png" ?> class="w-100 rounded-lg card-img-top py-2">
            </div>
            <div class="row">
              <div class="col-md-6 ml-4">
                <h5 class="card-title topic-title"><?= $topico->titulo_topico ?></h5>
                <p class="topic-desc">
                  <strong class="topic-desc">Data Limite: </strong>
                  <?php
                  echo ucwords(strftime('%A, %d/%m/%Y', strtotime($topico->dataLimite_topico)));
                  ?>
                </p>
                <p class="topic-desc">
                  <strong class="topic-desc">Aproximadamente: </strong>
                  <?= $topico->distancematrix->distance->text ?> —
                  <i><?= $topico->distancematrix->duration->text ?></i>
                </p>
                <p class="topic-desc">
                  <strong class="topic-desc">Peso: </strong>
                  <?= $topico->quant_residuo ?> Kg
                </p>
                <p class="topic-desc">
                  <strong class="topic-desc">Tipo: </strong>
                  <?= $topico->nome_tpResiduo ?></p>
                <p class="topic-desc">
                  <strong class="topic-desc">Empresa: </strong>
                  <?= $topico->nomeFantasia_dados ?></p>
              </div>
              <div class="col-md-5 d-flex align-items-center justify-content-center">
                <div class="container text-center">
                  <a href=<?= base_url('/CoopController/interesseTopico/' . $topico->id_topico); ?> class="btn-eco efeito active float-left w-100">Mostrar interesse</a>
                </div>
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
<!-- Topics that the Coop. are offering their services (END) -->
</div>