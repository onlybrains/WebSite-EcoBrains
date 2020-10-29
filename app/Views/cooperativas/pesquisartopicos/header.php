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
            <select class="form-control" name="tpResiduoFiltro" id="tpResiduoFiltro">
              <option disabled selected>Selecione o resíduo</option>
            <?php 
              foreach ($tipos as $tipo):
            ?>
              <option><?=$tipo->nome_tpResiduo?></option>
            <?php 
              endforeach 
            ?>
            </select>
          </div>
          <div class="form-group bg-light col-md-3 border-right border-bottom m-0 p-2">
            <label for="inputUser">Data Limite</label>
            <input type="date" class="form-control" name="dataLimiteFiltro" id="dataLimiteFiltro" value="<?= date('Y-m-d');?>">
          </div>
          <div class="form-group bg-light col-md-3 border-bottom m-0 p-2">
            <label for="inputUser">Peso</label>
            <input type="number" class="form-control" name="pesoFiltro" id="pesoFiltro" placeholder="Até..."/>
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
    foreach($topicos as $topico):
  ?>
  <div class="row my-2">
    <div class="col-lg-12 col-md-12 pb-3">
      <div class="card card-coop">
        <div class="card-body">
          <div class="container">
              <!--<a href="#" class="topic-button p-2 float-right" style="margin-top: 66px;"><img src="../imgs/topics-vector.png" width="37" height="25"></a>-->
              <a href="<?= base_url('/CoopController/interesseTopico/'.$topico->id_topico);?>" class="btn-eco efeito p-3 float-right" style="margin-top: 66px;">Mostrar interesse</a>
              <!--<a href="https://www.google.com/maps/dir//<?=$topico->cep_empresa?>" target="_blank" class="btn-eco efeito mr-4 p-4 float-right" style="margin-top: 66px;">Veja a localização da empresa</a>-->
              <img src="../imgs/image-random.png" class="mr-4 mt-5 float-right">
          </div>
          <div class="row">
              <h5 class="card-title topic-title ml-3"><?=$topico->titulo_topico?></h5>
          </div>
          <div class="row ml-3">
            <strong class="topic-desc">Data Limite: </strong>
            <p class="topic-desc ml-1">
              <?php
                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');
                echo ucwords(strftime('%A, %d/%m/%Y', strtotime($topico->dataLimite_topico)));
              ?>
            </p>
          </div>
          <div class="row ml-3">
            <strong class="topic-desc">Peso: </strong>
            <p class="topic-desc ml-2"> <?=$topico->quant_residuo?> Kg</p>
          </div>
          <div class="row ml-3">
            <strong class="topic-desc">Tipo: </strong>
            <p class="topic-desc ml-2"><?=$topico->nome_tpResiduo?></p>
          </div>
          <div class="row ml-3">
            <strong class="topic-desc">Empresa: </strong>
            <p class="topic-desc ml-2"><?=$topico->nomeFantasia_empresa?></p>
          </div>
          <div class="row ml-3">
            <a class="topic-maps mb-3" target="_blank" href="https://www.google.com/maps/dir//<?=$topico->cep_empresa?>">Clique aqui e veja a localização da empresa</a>
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