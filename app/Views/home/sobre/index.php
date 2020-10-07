<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar'); ?>

<?= $view->render('home/sobre/header'); ?>

<?= $view->render('home/sobre/jumbotron'); ?>

<?= $view->render('home/sobre/projetos'); ?>

<?= $view->render('layout/footer'); ?>

<?= $this->endSection('content') ?>