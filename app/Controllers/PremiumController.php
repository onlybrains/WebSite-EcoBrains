<?php

namespace App\Controllers;

use App\Models\CoopModel;
use App\Models\UserModel;
use App\Models\EmpresaModel;

Class PremiumController extends BaseController
{

  public function premium()
	{
		return view ('premium/index.php');
  }
  
}
?>