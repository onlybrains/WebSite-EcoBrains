<?php helper('html'); 
echo $this->extend('layout/index')?>

<?= $this->section('styles') ?>
lalalalalalala
<?= $this->endSection('styles') ?>

<!-- Navbar -->
<nav class="fixed-top navbar navbar-expand-lg navbar-fundo">

    <div class="container-fluid mx-5">

        <a class="navbar-brand h1 mt-2" href="index.html">
            <img src="imgs/eco-logo-branco.png" id="logo-nav" alt="Logo da EcoBrains">
            <img src="imgs/eco-branco.png" id="name-nav" alt="Logo da EcoBrains">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
            <span class="navbar-toggler-icon icon-hambuger"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSite">

            <ul class="navbar-nav ml-auto mt-1">

                <li class="nav-item marginItens">
                    <a class="nav-link nav-tamanho" href="index.html">Início</a>
                </li>
                <li class="nav-item marginItens">
                    <a class="nav-link nav-tamanho" href="indexSobreNos.html">Sobre nós</a>
                </li>
                <li class="nav-item marginItens">
                    <a class="nav-link nav-tamanho" href="indexPEV.html">PEV's</a>
                </li>
                <li class="nav-item marginItens">
                    <a class="nav-link nav-tamanho" href="#">Planos</a>
                </li>
                <li class="nav-item marginItens">
                    <a class="nav-link nav-tamanho" href="indexLogin.html">Login</a>
                </li>
                <li class="nav-item marginItens">
                    <a class="nav-link nav-tamanho" href="#">Cadastre-se</a>
                </li>
            </ul>

        </div>

    </div>
    <!-- End Navbar -->