<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar'); ?>

<?= $view->render('home/planos/header'); ?>

<?= $view->render('home/planos/planos'); ?>

<?= $view->render('layout/footer'); ?>

<?= $this->endSection('content') ?>