<?php
$view = \Config\Services::renderer();
$this->extend('layout/index');
helper('html');
?>

<?= $this->section('styles') ?>

<?php
echo link_tag('css/styles.css');
echo link_tag('css/styleNavBar.css');
echo link_tag('css/styleCoopTexts.css');
echo link_tag('css/styleHeader.css');
?>

<?= $this->endSection('styles') ?>


<?= $this->section('content'); ?>

<?php 
echo $view->render('layout/navbarLogado');
echo $view->render('premium/premium');
echo $view->render('premium/recomendations');
 ?>

<?= $this->endSection('content'); ?>