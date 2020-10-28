<?php 
$view = \Config\Services::renderer();
$this->extend('layout/index');
helper('html');
?>

<?= $this->section('styles') ?>

<?php
echo link_tag('css/styles.css');
echo link_tag('css/styleNavBar.css');
echo link_tag('css/styleCards.css');
echo link_tag('css/styleCoopTexts.css');
?>

<?= $this->endSection('styles') ?>


<?= $this->section('content') ?>

<?php 
echo $view->render('layout/navbarLogado');
echo $view->render('empresas/empresas'); 
?>

<?= $this->endSection('content')?>