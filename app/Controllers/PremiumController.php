<?php

namespace App\Controllers;

use App\Models\CoopModel;
use App\Models\UserModel;
use App\Models\EmpresaModel;

Class PremiumController extends BaseController
{

  public function premium()
	{
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = '$empresa';
		return view ('premium/index.php', $data);
  }
  
}
