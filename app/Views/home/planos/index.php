<?php
$view = \Config\Services::renderer();
$this->extend('layout/index');
helper('html');
?>

<?= $this->section('styles') ?>

<?php
echo link_tag('css/styles.css');
echo link_tag('css/styleNavBar.css');
echo link_tag('css/styleHeaderSobreNos.css');
echo link_tag('css/styleFilter.css');
echo link_tag('css/stylePlanos.css');
echo link_tag('css/styleFooter.css');
?>

<?= $this->endSection('styles') ?>


<?= $this->section('content') ?>

<?php
echo $view->render('layout/navbar');
echo $view->render('home/planos/header');
echo $view->render('home/planos/planos');
echo $view->render('layout/footer');
?>

<?= $this->endSection('content') ?>