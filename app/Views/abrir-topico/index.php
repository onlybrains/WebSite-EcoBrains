<?php 
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>

<?= $this->section('content') ?>

<?= $view->render('layout/navbarLogado'); ?>

<?= $view->render('abrir-topico/abrir-topico'); ?>

<?= $this->endSection('content')?>