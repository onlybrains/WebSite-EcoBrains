<?php 
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>

<?= $this->section('content') ?>

<?= $view->render('layout/navbarLogado'); ?>

<?= $view->render('empresas/abrir-topico/abrir-topico'); ?>

<?= $this->endSection('content')?>