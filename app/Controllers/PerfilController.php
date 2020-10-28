<?php

namespace App\Controllers;

use App\Models\CoopModel;
use App\Models\UserModel;
use App\Models\EmpresaModel;

Class PerfilController extends BaseController
{

  public function viewPerfil()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

		return view('perfil/view-perfil/index', $data);
	}

	public function editarPerfil(){
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

		return view('perfil/editar-perfil/index', $data);
  }
  
}

?>