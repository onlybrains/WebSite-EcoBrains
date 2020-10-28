<?php

namespace App\Controllers;

use App\Models\EmpresaModel;

Class EmpresaController extends BaseController
{
  public function empresas()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = '$empresa';

		return view('empresas/index', $data);
  }	
  
  public function abrirTopico()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

		return view('empresas/abrir-topico/index', $data);
  }
  
  public function editarTopico()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

		return view('empresas/editar-topico/index', $data);
  }

  public function viewTopico()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

		return view('empresas/view-topico/index', $data);
  }

}
