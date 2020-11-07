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
echo link_tag('css/stylePerfil.css');
?>

<?= $this->endSection('styles') ?>


<?= $this->section('content') ?>

<?php
echo $view->render('layout/navbarLogado');
echo $view->render('perfil/view-perfil/view-perfil');
?>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
<script src="/js/jquery.mask.js"></script>
<script src="/js/viaCEP.js"></script>
<script>
  consultaCEP($('#inputCEP').text()).then(response => {
    $('#inputEnd').text(response);
  })
</script>

<?= $this->endSection('script') ?>