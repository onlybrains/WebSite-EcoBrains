<?php
$uri = new \CodeIgniter\HTTP\URI(current_url());
helper('validation');

?>
<div class="container my-5">

  <div class="card mt-5 rounded shadow">
    <?php if (file_exists($user->banner_desc)) : ?>
      <div class="container my-2">
        <img src=<?= base_url($user->banner_desc) ?> class="rounded-lg card-img-top" alt="Imagem da Empresa">
      </div>
    <?php endif ?>

    <div class="card-body">

      <div class="row mb-2">
        <?php if (file_exists($user->logo_desc)) : ?>
          <div class="container my-2">
            <img src=<?= base_url($user->logo_desc) ?> class="card-img-logo" alt="Logo da Empresa">
          </div>
        <?php endif ?>
        <div class="col-md-6 d-block d-md-none">
          <p>
            <b>Nome:</b>
            <?= $user->nomeFantasia_dados ?>
            <?php if ($user->premium_desc == 1) : ?>
              <img src=<?= base_url('imgs/selo-ecoB.png') ?> class="card-img-premium" alt="Imagem da Empresa">
            <?php endif ?>
          </p>
          <p>
            <b>Razão Social:</b>
            <span><?= $user->razaoSoc_dados ?></span>
          </p>
          <p>
            <b>Descrição:</b>
            <span><?= nl2br($user->info_desc) ?></span>
          </p>
        </div>
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
        </div>

        <div class="col-md-6 d-none d-md-block">
          <h5 class="card-title">Nome: <?= $user->nomeFantasia_dados ?>
            <?php if ($user->premium_desc == 1) : ?>
              <img src=<?= base_url('imgs/selo-ecoB.png') ?> class="card-img-premium" alt="Imagem da Empresa">
            <?php endif ?>
          </h5>
          <h6 class="card-title ">Razão Social: <?= $user->razaoSoc_dados ?></h6>
          <h6 class="card-title ">Descrição:</h6>
          <p class="card-text">

            <?= nl2br($user->info_desc) ?>

          </p>
        </div>
        <?php if ($uri->getSegment(2) !== 'coop' && $uri->getSegment(2) !== 'empresa') : ?>
          <div class="d-flex col">
            <a href=<?= base_url($uri->getSegment(1) . '/perfil/editar') ?> class="btn btn-green flex-fill p-2">Editar Perfil</a>
          </div>
        <?php endif ?>
      </div>

    </div>
  </div>

</div>