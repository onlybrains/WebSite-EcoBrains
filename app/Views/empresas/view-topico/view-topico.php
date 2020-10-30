<div class="container">

  <div class="row mt-5">
    <div class="col-md-9">
      <?php
      foreach ($registros as $registro) :
      ?>
        <h1><?= $registro->titulo_topico ?></h1>
      <?php
      endforeach;
      ?>
    </div>

    <div class="col-md-3">
      <div class="row">
        <a href="<?= base_url('/empresas/editartopico') ?>" class="topic-button p-2 mt-2 mr-2 text-white">
          Editar Tópico
        </a>
        <a href="#" class="topic-button p-2 mt-2 mr-4 text-white"><svg width="37" height="27" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
          </svg></a>
      </div>
    </div>


  </div>

  <div class="row mt-3 mb-4">
    <div class="rounded-lg sign-up col-12 bg-light">
      <form>
        <div class="form-row">
          <div class="form-group col-md-4 border-right border-bottom m-0 p-2">
            <label for="inputEmail">Tipo de Resíduo</label>
            <input class="form-control" type="text" placeholder="Papel" readonly>
          </div>
          <div class="form-group col-md-4 border-right border-bottom m-0 p-2">
            <label for="inputUser">Quantidade de resíduos</label>
            <input class="form-control" type="text" placeholder="26/10/2020" readonly>
          </div>
          <div class="form-group col-md-4 border-bottom m-0 p-2">
            <label for="inputUser">Distância</label>
            <input class="form-control" type="text" placeholder="25Kg" readonly>
      </form>
    </div>


    <!--Init Cards-->

    <div class="col-lg-12 col-md-12 pb-3 mt-4">

      <h6>Cooperativas Interessadas:</h6>
      <?php
      foreach ($registros as $registro) :
      ?>
        <div class="card-coop border">

          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <div class="row">
                  <h5 class="card-title topic-title ml-3"><?= $registro->titulo_topico ?></h5>
                </div>
                <div class="row">
                  <p class="topic-desc ml-3">Data: 26/10/2020</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <a href="#" class="topic-button p-2 mt-4 mr-4 text-white">
                    Conheça a Cooperativa
                  </a>
                  <a href="#" class="topic-button p-2 mt-4 mr-4 text-white"><svg width="37" height="27" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
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