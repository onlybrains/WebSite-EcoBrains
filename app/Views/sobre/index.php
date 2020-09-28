<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar'); ?>

<?= $view->render('sobre/header'); ?>

<?= $view->render('sobre/jumbotron'); ?>

<?= $view->render('sobre/projetos'); ?>

<?= $view->render('layout/footer'); ?>

<?= $this->endSection('content') ?>