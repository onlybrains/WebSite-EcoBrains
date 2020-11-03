<?php
$uri = new \CodeIgniter\HTTP\URI(current_url());
?>
<div class="container">
  <div class="card my-5 rounded shadow">
    <div class="card-body">
      <form method="POST">
        <div class="row">
          <div class="col">
            <div id="img-container-preview-logo" class="mx-4 mb-4 text-center">
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputLogo" accept="image/png, image/jpeg">
              <label class="custom-file-label" for="inputLogo" data-browse="Buscar">Selecionar Logo</label>
            </div>
          </div>
          <div class="col">
            <div id="img-container-preview-banner" class="mx-4 mb-4 text-center">
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputBanner">
              <label class="custom-file-label" for="inputBanner" data-browse="Buscar">Selecionar Banner</label>
            </div>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputCNPJ"><b>CNPJ:</b></label>
                <input type="text" class="form-control border-0 ml-2" name="inputCNPJ" id="inputCNPJ">
              </div>
              <small class="form-text text-muted">
                0000000000000000000000
              </small>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputTempMercado"><b>Tempo de Mercado (Fundação):</b></label>
                <input type="date" class="form-control border-0 ml-2 col" name="inputTempMercado" id="inputTempMercado">
              </div>
              <small class="form-text text-muted">
                00/00/0000
              </small>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputCEP"><b>CEP:</b></label>
                <input type="text" class="form-control border-0 ml-2 mr-4" name="inputCEP" id="inputCEP">
                <label for="inputNumEnd"><b>Número:</b></label>
                <input type="number" class="form-control border-0 col-3" name="inputNumEnd" id="inputNumEnd" min="0" max="99999">
              </div>
              <div class="d-flex justify-content-between">
                <small class="form-text text-muted">
                  07193-270
                </small>
                <small class="form-text text-muted">
                  0000
                </small>
              </div>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputTempMercado"><b>Endereço:</b></label>
                <input type="text" class="form-control border-0 ml-2" name="inputTempMercado" id="inputTempMercado">
              </div>
              <small class="form-text text-muted">
                TRua Castelo Branco, 215 - Casa Dois
              </small>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputComplemento"><b>Complemento:</b></label>
                <input type="text" class="form-control border-0 ml-2" name="inputComplemento" id="inputComplemento">
              </div>
              <small class="form-text text-muted">
                Casa 02
              </small>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputTel"><b>Telefone:</b></label>
                <input type="text" class="form-control border-0 ml-2 mr-4" name="inputTel" id="inputTel">
                <label for="inputWhats"><b>WhatsApp:</b></label>
                <input type="number" class="form-control border-0 col-3" name="inputWhats" id="inputWhats" min="0" max="99999">
              </div>
              <div class="d-flex justify-content-between">
                <small class="form-text text-muted">
                  11 005555505050
                </small>
                <small class="form-text text-muted">
                  11 005555505050
                </small>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputFantasia"><b>Nome Fantasia:</b></label>
                <input type="text" class="form-control border-0 ml-2 col" name="inputFantasia" id="inputFantasia">
              </div>
              <small class="form-text text-muted">
                Nome Fantasia
              </small>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputRazao"><b>Razão Social:</b></label>
                <input type="text" class="form-control border-0 ml-2 col" name="inputRazao" id="inputRazao">
              </div>
              <small class="form-text text-muted">
                Razão Social
              </small>
            </div>
            <div class="form-group">
              <label for="inputTxtArea"><b>Descrição:</b></label>
              <textarea class="form-control" id="inputTxtArea" rows="10"></textarea>
            </div>
            <div class="form-group p-2 border-bottom">
              <div class="d-flex align-items-end justify-content-between">
                <label for="inputSite"><b>Site:</b></label>
                <input type="text" class="form-control border-0 ml-2" name="inputSite" id="inputSite">
              </div>
              <small class="form-text text-muted">
                www.site.com
              </small>
            </div>
          </div>
        </div>
        <div class="d-flex">
          <a href=<?= base_url($uri->getSegment(1) . '/perfil/editar') ?> class="btn btn-green flex-fill p-2">Editar Perfil</a>
        </div>
      </form>
    </div>
  </div>
</div>