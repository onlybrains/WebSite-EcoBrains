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
echo link_tag('css/styleSignUp.css');
echo link_tag('css/styleLists.css');
echo link_tag('css/styleButtons.css');
echo link_tag('css/stylePerfil.css');
echo link_tag('css/styleDropdown.css');
?>

<?= $this->endSection('styles') ?>

<?= $this->section('content') ?>

<?php
echo $view->render('layout/navbarLogado');
echo $view->render('cooperativas/pesquisartopicos/header');
?>

<?= $this->endSection('content') ?>