<?php
$uri = new \CodeIgniter\HTTP\URI(current_url());
helper('validation')
?>
<div class="container">

  <div class="card mt-5 rounded shadow">
    <?= '$user->banner_desc' ?>
    <img src=<?= '$user->banner_desc' ?> class="card-img-top" alt="Imagem da Empresa">
    <div class="card-body">

      <div class="row mb-2">
        <div class="col-md-6">
          <?= '$user->logo_desc' ?>
          <p>
            <b>CNPJ:</b>
            <span><?= mask($user->cnpj_dados, '##.###.###/####-##') ?></span>
          </p>
          <p>
            <b>Tempo de Mercado:</b>
            <span><?= $user->tempoMercado_desc ?></span>
          </p>
          <p>
            <b>CEP:</b>
            <span id="inputCEP"><?= mask($user->cep_dados, '#####-###') ?></span>
          </p>
          <p>
            <b>Endereço:</b>
            <span id="inputEnd"></span>
          </p>
          <p>
            <b>Número:</b>
            <span><?= $user->numEnd_dados ?></span>
          </p>
          <p>
            <b>Complemento:</b>
            <span><?= $user->complemento_dados ?></span>
          </p>
          <p>
            <b>Telefone:</b>
            <span><?= mask($user->tel_dados, '(##) ####-####') ?></span>
          </p>
          <p>
            <b>WhatsApp:</b>
            <span><?= mask($user->whatsapp_dados, '(##) # ####-####') ?></span>
          </p>
          <p>
            <b>Site:</b>
            <span><?= $user->site_desc ?></span>
          </p>
          <div class="d-flex">
            <a href=<?= base_url($uri->getSegment(1) . '/perfil/editar') ?> class="btn btn-green flex-fill p-2">Editar Perfil</a>
          </div>
        </div>

        <div class="col-md-6">
          <h5 class="card-title ">Nome: <?= $user->nomeFantasia_dados ?> <?= '$user->premium_desc' ?></h5>
          <h6 class="card-title ">Razão Social: <?= $user->razaoSoc_dados ?></h6>
          <h6 class="card-title ">Descrição:</h6>
          <p class="card-text">
            <?= $user->info_desc ?>
          </p>
        </div>
      </div>

    </div>
  </div>

</div>