<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar'); ?>

<?= $view->render('pevs/header'); ?>

<?= $view->render('pevs/pevs'); ?>

<?= $view->render('pevs/horarios'); ?>

<?= $view->render('layout/footer'); ?>

<?= $this->endSection('content') ?>