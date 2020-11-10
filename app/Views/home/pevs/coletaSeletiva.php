<div class="container pt-1">
  <div class="row row-cols-2 justify-content-center pb-4">
    <?php foreach ($registros as $registro) : ?>
      <div class="col-md-offset-3 col-md-6">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="district">
              <h4 class="panel-title text-center">
                <a class="first" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $registro->id_coletaSeletiva ?>" aria-expanded="true" aria-controls="collapse<?= $registro->id_coletaSeletiva ?>">
                  <?= $registro->bairro_coletaSeletiva ?>
                  <span> </span>
                </a>
              </h4>
            </div>
            <div id="collapse<?= $registro->id_coletaSeletiva ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="district">
              <div class="panel-body">
                <p class="text2">A coleta seletiva em <span class="text4"><?= $registro->bairro_coletaSeletiva ?>
                  </span> acontece sempre
                  nos(as) <span class="text4"><?= $registro->diasSemana_coletaSeletiva ?></span>.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>