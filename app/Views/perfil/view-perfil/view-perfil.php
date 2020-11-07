<?php
$uri = new \CodeIgniter\HTTP\URI(current_url());
helper('validation');

?>
<div class="container">

  <div class="card mt-5 rounded shadow">
    <?php if ($user->banner_desc) : ?>
      <div class="container my-2">
        <img src=<?= $user->banner_desc ?> class="rounded-lg card-img-top" alt="Imagem da Empresa">
      </div>
    <?php endif ?>

    <div class="card-body">

      <div class="row mb-2">
        <?php if ($user->logo_desc) : ?>
          <div class="container my-2">
            <img src=<?= $user->logo_desc ?> class="card-img-logo" alt="Logo da Empresa">
          </div>
        <?php endif ?>
        <div class="col-md-6">
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
          <h5 class="card-title">Nome: <?= $user->nomeFantasia_dados ?>
            <?php if ($user->premium_desc == 1) : ?>
              <img src=<?= base_url('imgs/selo-ecoB.png') ?> class="card-img-premium" alt="Imagem da Empresa">
            <?php endif ?>
          </h5>
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