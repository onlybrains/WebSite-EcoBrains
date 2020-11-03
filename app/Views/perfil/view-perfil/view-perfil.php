<?php
$uri = new \CodeIgniter\HTTP\URI(current_url());
?>
<div class="container">

  <div class="card mt-5 rounded shadow">
    <img src="/imgs/banner.png" class="card-img-top" alt="Imagem da Empresa">
    <div class="card-body">

      <div class="row mb-2">
        <div class="col-md-6 mt-5">
          <p> <b>CNPJ:</b> 23.105.371/0001-33</p>
          <p> <b>Tempo de Mercado:</b> 23.105.371/0001-33</p>
          <p> <b>Endereço:</b> 23.105.371/0001-33</p>
          <p> <b>Email:</b> 23.105.371/0001-33</p>
          <p> <b>Celular:</b> 23.105.371/0001-33</p>
          <p> <b>Telefone:</b> 23.105.371/0001-33</p>
          <div class="d-flex">
            <a href=<?= base_url($uri->getSegment(1) . '/perfil/editar') ?> class="btn btn-green flex-fill p-2">Editar Perfil</a>
          </div>
        </div>

        <div class="col-md-6">
          <h5 class="card-title ">$Nome</h5>
          <h6 class="card-title ">Descrição:</h6>
          <p class="card-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores recusandae minima ducimus officia unde consequuntur sit nihil esse? Soluta nam voluptatem tempora quisquam quasi asperiores praesentium delectus error impedit amet. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit soluta eveniet distinctio magni, perspiciatis tempore tenetur, atque temporibus modi et cum deleniti dolore pariatur dolores accusamus laudantium hic, aliquam incidunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita magni iure tenetur, dolores est quae illum ex vel laudantium minus ipsa suscipit omnis accusamus quibusdam consequatur sint delectus doloribus voluptate?
          </p>
        </div>
      </div>

    </div>
  </div>

</div>