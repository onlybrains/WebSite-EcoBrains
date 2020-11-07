<?php
$view = \Config\Services::renderer();
$this->extend('layout/index');

helper('html');
?>

<?= $this->section('styles') ?>

<?php
echo link_tag('css/styles.css');
echo link_tag('css/styleNavBar.css');
echo link_tag('css/styleHeader.css');
echo link_tag('css/styleButtons.css');
echo link_tag('css/styleCarousel.css');
echo link_tag('css/styleCards.css');
echo link_tag('css/styleSobreNos.css');
echo link_tag('css/styleFooter.css');
?>

<?= $this->endSection('styles') ?>


<?= $this->section('content') ?>

<?php
echo $view->render('layout/navbar');
echo $view->render('home/home/header');
echo $view->render('home/home/empresas');
echo $view->render('home/home/quemSomos');
echo $view->render('home/home/team');
echo $view->render('home/home/planos');
echo $view->render('layout/footer');
?>

<?= $this->endSection('content') ?>