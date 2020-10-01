<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar') ?>

<?= $view->render('sign-up/dados') ?>

<?= $this->endSection('content') ?>