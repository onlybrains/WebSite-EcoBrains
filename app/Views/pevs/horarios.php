<div class="container-fluid pt-3">
  <div class="row my-2">
    <div class="col-12 text-center">
      <h2 class="text text-center mb-4">COLETA SELETIVA</h2>
      <hr class="line-footer-green" />
    </div>
  </div>
  <div class="row">
    <div class="col-12 mb-3">
      <p class="ecobrainsGreen text-center">Preencha as informações no filtro abaixo para localizar as datas e
        horários da
        coleta seletiva em sua região.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-12" style="text-align: center;">
      <form class="filters" method="_POST">
        <label for="states" class="text3 ">Estado:</label>
        <select name="states" id="states" form="statesform">
          <option value="SP">São Paulo</option>
        </select>
        <label for="city" class="text3 ml-2">Cidade:</label>
        <select name="city" id="city" form="cityform">
          <option value="Guarulhos">Guarulhos</option>
          <option value="SaoPaulo" disabled>São Paulo</option>
        </select>
        <label for="district" class="text3 ml-2">Escolha seu bairro:</label>
        <select name="district" id="district" form="districtform">
          <option value="ADICIONARNOBANCO" disabled>ADICIONAR NO BANCO</option>
        </select>
        <br>
        <label for="district" class="text3 ml-2">Insira seu CEP:</label>
        <input type="text" placeholder="Insira seu CEP (00000000)" />
    </div>
  </div>
  <div class="row pt-4 pb-4">
    <div class="col-12" style="text-align: center;">
      <button class="btn btn-lg btn-eco efeito active" type="submit">Pesquisar</button>
      </form>
    </div>
  </div>
</div>
<div class="container">
  <div class="row justify-content-center pb-4">
    <div class="col-md-offset-3 col-md-6">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="district">
            <h4 class="panel-title text-center">
              <a class="first" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                #DistrictName
                <span> </span>
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="district">
            <div class="panel-body">
              <p class="text2">A coleta seletiva em <span class="text4">Bairro</span> acontece sempre
                nos(as) <span class="text4">dia(s)</span> durante o período das <span class="text4">00h</span> às <span class="text4">00h</span>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>