<?php
$view = \Config\Services::renderer();
$this->extend('layout/index');
helper('html');
?>

<?= $this->section('styles') ?>

<?php
echo link_tag('css/styles.css');
echo link_tag('css/styleNavBar.css');
echo link_tag('css/styleFilter.css');
echo link_tag('css/styleFooter.css');
echo link_tag('css/styleButtons.css');
?>

<?= $this->endSection('styles') ?>


<?= $this->section('content') ?>

<?php
echo $view->render('layout/navbar');
echo $view->render('home/pevs/header');
echo $view->render('home/pevs/pevs');
echo $view->render('home/pevs/horarios');
echo $view->render('layout/footer');
?>

<?= $this->endSection('content') ?>