<?php
$view = \Config\Services::renderer();
$this->extend('layout/index');
helper('html');
?>

<?= $this->section('styles') ?>

<?php
echo link_tag('css/styles.css');
echo link_tag('css/styleNavBar.css');
echo link_tag('css/styleSignUp.css');
?>

<?= $this->endSection('styles') ?>


<?= $this->section('content') ?>

<?php
echo $view->render('layout/navbar');
echo $view->render('sign-up/dados');
?>

<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
<script src="/js/jquery.mask.js"></script>
<script src="/js/viaCEP.js"></script>
<script>
  $('#inputCEP').focusout(async function() {
    $("#inputEnd").val(await consultaCEP(this.value))
  });

  $("#inputCNPJ").keydown(function() {

    $('#inputCNPJ').mask('99.999.999/9999-99');

  });

  $("#inputCEP").keydown(function() {

    $('#inputCEP').mask('00000-000');

  });


  $("#inputTel").keydown(function() {

    $('#inputTel').mask('(00) 0000-0000');

  });

  $("#inputWhats").keydown(function() {

    $('#inputWhats').mask('(00) 00000-0000');

  });
</script>

<?= $this->endSection('script') ?>