<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar') ?>

<?= $view->render('login/login') ?>

<?= $this->endSection('content') ?>