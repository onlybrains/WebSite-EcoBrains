<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar'); ?>

<?= $view->render('home/header'); ?>

<?= $view->render('home/empresas'); ?>

<?= $view->render('home/quemSomos'); ?>

<?= $view->render('home/team'); ?>

<?= $view->render('home/planos'); ?>

<?= $view->render('home/footer'); ?>

<?= $this->endSection('content') ?>