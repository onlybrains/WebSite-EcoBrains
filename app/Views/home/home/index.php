<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar'); ?>

<?= $view->render('home/home/header'); ?>

<?= $view->render('home/home/empresas'); ?>

<?= $view->render('home/home/quemSomos'); ?>

<?= $view->render('home/home/team'); ?>

<?= $view->render('home/home/planos'); ?>

<?= $view->render('layout/footer'); ?>

<?= $this->endSection('content') ?>