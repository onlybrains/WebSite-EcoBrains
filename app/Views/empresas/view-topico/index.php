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
echo link_tag('css/styleDropdown.css');
echo link_tag('css/styleSignUp.css');
?>

<?= $this->endSection('styles') ?>

<?= $this->section('content');?>

<?php
echo $view->render('layout/navbarLogado');
echo $view->render('empresas/view-topico/view-topico');
?>

<?= $this->endSection('content');?>