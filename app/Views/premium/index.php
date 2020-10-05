<?php
$view = \Config\Services::renderer();
$this->extend('layout/index');
?>

<?= $this->section('content');?>

<?= $view->render('layout/navbarLogado')?>

<?= $view->render('premium/premium')?>

<?= $view->render('premium/recomendations')?>

<?= $this->endSection('content');?>