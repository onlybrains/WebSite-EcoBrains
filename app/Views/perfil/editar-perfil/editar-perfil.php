<?php
$uri = new \CodeIgniter\HTTP\URI(current_url());
helper('validation');
?>
<div class="container">
  <?php if (!empty($errors)) : ?>
    <div class="row justify-content-center pt-5 mx-1">
      <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $field => $error) : ?>
          <p><?= $error ?></p>
        <?php endforeach ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="card my-5 rounded shadow">
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="row mb-2">
          <div class="col-12 d-none d-sm-block">
            <div class="form-row ">
              <div class="col-md-6">
                <div id="img-container-preview-logo" class="my-4 text-center">
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputLogo" name="inputLogo" accept="image/png, image/jpeg">
                  <label class="custom-file-label" for="inputLogo" data-browse="Buscar">Selecionar Logo</label>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div id="img-container-preview-banner" class="my-4 text-center">
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputBanner" name="inputBanner">
                  <label class="custom-file-label" for="inputBanner" data-browse="Buscar">Selecionar Banner</label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputCNPJ"><b>CNPJ:</b></label>
                <input type="text" class="form-control  ml-2" name="inputCNPJ" id="inputCNPJ" value="<?= mask($user->cnpj_dados, '##.###.###/####-##') ?>" disabled>
              </div>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="form-row">
                <label for="inputTempMercado"><b>Tempo de Mercado (Fundação):</b></label>
                <input type="date" class="form-control" name="inputTempMercado" id="inputTempMercado" value="<?= $user->tempoMercado_desc ?>">
                <small class="form-text text-muted">
                  <?= $user->tempoMercado_desc ?>
                </small>
              </div>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="inputCEP"><b>CEP:</b></label>
                  <input type="text" class="form-control" name="inputCEP" id="inputCEP" value="<?= $user->cep_dados ?>">
                  <small class="form-text text-muted">
                    <span id="htmlCEP"><?= mask($user->cep_dados, '#####-###') ?></span>
                  </small>
                </div>
                <div class="col-md-6">
                  <label for="inputNumEnd"><b>Número:</b></label>
                  <input type="number" class="form-control" name="inputNumEnd" id="inputNumEnd" min="0" max="99999" value="<?= $user->numEnd_dados ?>">
                  <small class="form-text text-muted">
                    <?= $user->numEnd_dados ?>
                  </small>
                </div>
              </div>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputEnd"><b>Endereço:</b></label>
                <input type="text" class="form-control  ml-2" name="inputEnd" id="inputEnd" readonly>
              </div>
              <small class="form-text text-muted">
                <span id="htmlEnd"></span>
              </small>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputComplemento"><b>Complemento:</b></label>
                <input type="text" class="form-control  ml-2" name="inputComplemento" id="inputComplemento" value="<?= $user->complemento_dados ?>">
              </div>
              <small class="form-text text-muted">
                <?= $user->complemento_dados ?>
              </small>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="inputTel"><b>Telefone:</b></label>
                  <input type="text" class="form-control" name="inputTel" id="inputTel" value="<?= mask($user->tel_dados, '(##) ####-####') ?>">
                  <small class="form-text text-muted">
                    <?= mask($user->tel_dados, '(##) ####-####') ?>
                  </small>
                </div>
                <div class="col-md-6">
                  <label for="inputWhats"><b>WhatsApp:</b></label>
                  <input type="text" class="form-control" name="inputWhats" id="inputWhats" value="<?= mask($user->whatsapp_dados, '(##) # ####-####') ?>">
                  <small class="form-text text-muted">
                    <?= mask($user->whatsapp_dados, '(##) # ####-####') ?>
                  </small>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputFantasia"><b>Nome Fantasia:</b></label>
                <input type="text" class="form-control  ml-2 col" name="inputFantasia" id="inputFantasia" value="<?= $user->nomeFantasia_dados ?>">
              </div>
              <small class="form-text text-muted">
                <?= $user->nomeFantasia_dados ?>
              </small>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputRazao"><b>Razão Social:</b></label>
                <input type="text" class="form-control  ml-2 col" name="inputRazao" id="inputRazao" value="<?= $user->razaoSoc_dados ?>">
              </div>
              <small class="form-text text-muted">
                <?= $user->razaoSoc_dados ?>
              </small>
            </div>
            <div class="form-group">
              <label for="inputTxtArea"><b>Descrição:</b></label>
              <textarea class="form-control" id="inputTxtArea" name="inputTxtArea" rows="10"><?= $user->info_desc ?></textarea>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputSite"><b>Site:</b></label>
                <input type="text" class="form-control  ml-2" name="inputSite" id="inputSite" value="<?= $user->site_desc ?>">
              </div>
              <small class="form-text text-muted">
                <?= $user->site_desc ?>
              </small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col d-flex">
            <button type="submit" class="btn btn-green flex-fill p-2">Editar Perfil</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>