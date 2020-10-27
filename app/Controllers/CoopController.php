<?php

namespace App\Controllers;

use App\Models\CoopModel;

Class CoopController extends BaseController
{
  public function cooperativas()
	{
    $data['titulo'] = 'Pesquisar Tópicos';
    $data['nome'] = '$cooperativa';
    
		echo view('cooperativas/index', $data);
  }	
  
  public function pesquisartopicos($id=1)
	{
		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = '$cooperativa';
		
		$coopController = new \App\Models\TopicoModel();
		$registros = $coopController->table('tb_topico')
		->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
		->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
		->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
		->findAll();
		//$registros = $coopController->find();
		
		$data['topicos'] = $registros;
		//var_dump($registros);
		return view('cooperativas/pesquisartopicos/index', $data);
	}	

	public function pesquisarempresas()
	{
		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = '$cooperativa';

		$coopController = new \App\Models\EmpresaModel();
		$registros = $coopController -> find();

		$data['empresas'] = $registros;

		return view('cooperativas/pesquisarempresas/index', $data);
	}	

}


?>