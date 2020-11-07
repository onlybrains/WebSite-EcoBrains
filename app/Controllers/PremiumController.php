<?php

namespace App\Controllers;

use App\Models\CoopModel;
use App\Models\UserModel;
use App\Models\EmpresaModel;

class PremiumController extends BaseController
{

  public function premium()
  {
    helper(['auth', 'validation']);

    $user = getBasicUserInfo();

    $data['user'] = $user;
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = $user->nomeFantasia_dados;
    return view('premium/index.php', $data);
  }
}