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
    foreach($empresas as $empresa):
  ?>
  <div class="row my-2">
    <div class="col-lg-12 col-md-12 pb-3">
      <div class="card card-coop">
        <div class="card-body">
          <div class="container">
              <!--<a href="#" class="topic-button p-2 float-right" style="margin-top: 66px;"><img src="../imgs/topics-vector.png" width="37" height="25"></a>-->
              <a href="<?= base_url('/CoopController/solicitarcontato/'.$empresa->id_empresa);?>" class="btn-eco efeito p-3 float-right" style="margin-top: 30px;">Receber informações para contato</a>
              <!--<a href="https://www.google.com/maps/dir//<?=$empresa->cep_dados?>" target="_blank" class="btn-eco efeito mr-4 p-4 float-right" style="margin-top: 66px;">Veja a localização da empresa</a>-->
              <!-- <img src="../imgs/image-random.png" class="mr-4 mt-5 float-right"> -->
          </div>
          <div class="row">
              <h5 class="card-title topic-title ml-3"><?=$empresa->nomeFantasia_dados?></h5>
          </div>
          <div class="row ml-3">
            <strong class="topic-desc">CNPJ: </strong>
            <p class="topic-desc ml-2"> <?=substr($empresa->cnpj_dados,0,2).".".substr($empresa->cnpj_dados,2,3).".".substr($empresa->cnpj_dados,5,3)."/".substr($empresa->cnpj_dados,8,4)."-".substr($empresa->cnpj_dados,-2);?></p>
          </div>
          <!-- <div class="row ml-3">
            <strong class="topic-desc">Telefone: </strong>
            <p class="topic-desc ml-2"><?='(' . substr($empresa->tel_dados, 0, 2) . ') ' . substr($empresa->tel_dados, 2, 4) . '-' . substr($empresa->tel_dados, 6)?></p>
          </div>
          <div class="row ml-3">
            <strong class="topic-desc">WhatsApp: </strong>
            <p class="topic-desc ml-2"><?='(' . substr($empresa->whatsapp_dados, 0, 2) . ') ' . substr($empresa->whatsapp_dados, 2, 1) . ' ' . substr($empresa->whatsapp_dados, 3, 4) . '-' . substr($empresa->whatsapp_dados, 7)?></p>
          </div> -->
          <div class="row ml-3">
            <a class="topic-maps mb-3" target="_blank" href="https://www.google.com/maps/dir//<?=$empresa->cep_dados?>">Clique aqui e veja a localização da empresa</a>
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