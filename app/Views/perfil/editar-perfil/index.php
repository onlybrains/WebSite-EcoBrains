<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>

<?= $this->section('content')?>

<?= $view->render('layout/navbarLogado')?>

<?= $view->render('editar-perfil/editar-perfil')?>

<?= $this->endSection('content')?>