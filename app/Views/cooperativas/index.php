<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbarLogado'); ?>

<?= $view->render('cooperativas/header'); ?>

<?= $view->render('layout/footer'); ?>

<?= $this->endSection('content') ?>