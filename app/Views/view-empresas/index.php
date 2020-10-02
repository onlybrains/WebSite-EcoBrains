<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>

<?= $this->section('content') ?>

<?= $view->render('layout/navbarLogado'); ?>

<?= $view->render('view-empresas/view-empresas'); ?>

<?= $this->endSection('content') ?>