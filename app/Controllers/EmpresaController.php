<?php

namespace App\Controllers;

use App\Models\EmpresaModel;

Class EmpresaController extends BaseController
{
  public function empresas()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = '$empresa';

		echo view('empresas/index', $data);
  }	
  
  public function abrirTopico()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

		echo view('empresas/abrir-topico/index', $data);
  }
  
  public function editarTopico()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

		echo view('empresas/editar-topico/index', $data);
  }

  public function viewTopico()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

		echo view('empresas/view-topico/index', $data);
  }

}

?>