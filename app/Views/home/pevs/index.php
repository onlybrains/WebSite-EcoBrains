<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar'); ?>

<?= $view->render('home/pevs/header'); ?>

<?= $view->render('home/pevs/pevs'); ?>

<?= $view->render('home/pevs/horarios'); ?>

<?= $view->render('layout/footer'); ?>

<?= $this->endSection('content') ?>