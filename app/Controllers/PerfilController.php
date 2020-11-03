<?php

namespace App\Controllers;

use App\Models\CoopModel;
use App\Models\UserModel;
use App\Models\EmpresaModel;

class PerfilController extends BaseController
{

  public function viewPerfil()
  {
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

    return view('perfil/view-perfil/index', $data);
  }

  public function editarPerfil()
  {
    helper('auth_helper');
    $user = getBasicUserInfo();
    $uri = new \CodeIgniter\HTTP\URI(current_url());




    $data['titulo'] = $uri->getSegment(1) == 'empresas' ? 'Pesquisar Cooperativas' : 'Pesquisar Empresas';
    $data['nome'] = $user->nomeFantasia_dados;

    return view('perfil/editar-perfil/index', $data);
  }
}
