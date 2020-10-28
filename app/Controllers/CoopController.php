<?php

namespace App\Controllers;

use App\Models\CoopModel;

Class CoopController extends BaseController
{
  public function cooperativas()
	{
    $data['titulo'] = 'Pesquisar Empresas';
    $data['nome'] = '$cooperativa';
    
		return view('cooperativas/index', $data);
  }	
  
  public function pesquisartopicos()
	{
		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = '$cooperativa';
		
		return view('cooperativas/pesquisartopicos/index', $data);
	}	

	public function pesquisarempresas()
	{
		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = '$cooperativa';

		return view('cooperativas/pesquisarempresas/index', $data);
	}	

}
