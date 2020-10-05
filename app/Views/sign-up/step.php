<?php
$view = \Config\Services::renderer();
$this->extend('layout/index')
?>


<?= $this->section('content') ?>

<?= $view->render('layout/navbar') ?>

<?= $view->render('sign-up/dados') ?>

<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
<script src="/js/jquery.mask.js"></script>
<script>
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
</script>

<?= $this->endSection('script') ?>