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
echo $view->render('layout/navbarLogado');
echo $view->render('perfil/editar-perfil/editar-perfil');
?>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
<script src="/js/jquery.mask.js"></script>
<script>
  $('#inputLogo').change(function() {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#img-container-preview-logo > img').remove();
        $('#img-container-preview-logo ').append('<img class="rounded-circle" style="object-fit: cover;" img-fluid src="' + e.target.result + '" width="100" height="100">');
      };
      reader.readAsDataURL(this.files[0]);
    }
  })

  $('#inputBanner').change(function() {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#img-container-preview-banner > img').remove();
        $('#img-container-preview-banner ').append('<img class="rounded-lg w-100" style="object-fit: cover; height: 100px;" img-fluid src="' + e.target.result + '">');
      };
      reader.readAsDataURL(this.files[0]);
    }
  })
</script>
<!-- <script>
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


  $("#inputCEP").focusout(async function() {
    consultaCEP(this.value)
  });

  const consultaCEP = async (cep) => {

    cep = cep.replace('-', '')

    if (cep) {
      if (cep.length === 8) {
        const URL = `http://viacep.com.br/ws/${cep}/json`;
        const response = await axios.request(URL)
        let {
          logradouro,
          bairro,
          localidade,
          uf
        } = response.data

        if (logradouro == undefined || bairro == undefined || localidade == undefined || uf == undefined) {
          $("#inputEnd").val('CEP Inválido')
        } else {
          $("#inputEnd").val(`${logradouro}, ${bairro} - ${localidade}/${uf}`)
        }

      } else {
        $("#inputEnd").val('')
      }
    }
  }
</script> -->

<?= $this->endSection('script') ?>