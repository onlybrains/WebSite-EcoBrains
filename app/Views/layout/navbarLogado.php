<!-- Navbar -->
<nav class="sticky-top navbar navbar-expand-lg navbar-fundo">

  <div class="container-fluid mx-5">

    <a class="navbar-brand h1 mt-2" href=<?= base_url('/') ?>>
      <img src="imgs/eco-logo-branco.png" id="logo-nav" alt="Logo da EcoBrains">
      <img src="imgs/eco-branco.png" id="name-nav" alt="Logo da EcoBrains">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
      <span class="navbar-toggler-icon icon-hambuger"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSite">

      <ul class="navbar-nav ml-auto mt-1">

        <li class="nav-item marginItens">
          <a class="nav-link nav-tamanho" href=<?= base_url('/') ?>>Início</a>
        </li>
        <li class="nav-item marginItens">
          <a class="nav-link nav-tamanho" href=<?= base_url('/') ?>>Pesquisar Empresas</a>
        </li>
        <li class="nav-item marginItens">
          <a class="nav-link nav-tamanho" href=<?= base_url('/') ?>>Nome da Cooperativa</a>
        </li>
        <div class="dropdown transparentbar marginItens nav-link nav-tamanho" style="z-index:4">
          <button class="btn btn-default dropdown-toggle dropdown-Color" type="button" id="mybyn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <span class="caret"></span></button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>
      </ul>
    </div>
  </div>
</nav>