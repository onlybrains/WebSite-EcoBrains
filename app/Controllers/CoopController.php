<?php

namespace App\Controllers;

use App\Models\CoopModel;

Class CoopController extends BaseController
{
  public function cooperativas()
	{
    $data['titulo'] = 'Pesquisar Tópicos';
    $data['nome'] = '$cooperativa';
    
		return view('cooperativas/index', $data);
  }	
  
  public function pesquisartopicos()
	{
		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = '$cooperativa';
		
		$coopController = new \App\Models\TopicoModel();
		$registros = $coopController
		->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
		->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
		->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
		->where('dataLimite_topico >= CURRENT_DATE()')
		->findAll();

		$data['topicos'] = $registros;
		
		//var_dump($registros);
		return view('cooperativas/pesquisartopicos/index', $data);
	}

	// ARRUMAR //
	public function interesseTopico($id_topico = 1, $id_coop = 1){
		$coopController = new \App\Models\InteresseTopicoModel();
		$coopController
		->set('aprov_interesseTopico', '1')
		->set('id_topico', 1)
		->set('id_coop', 1)
		->insert();

		var_dump($coopController);

		//return redirect()->to(base_url('CoopController/Cooperativas'));
	}

	// ARRUMAR A ROTA NA VIEW
	public function pesquisafiltro(){
		$tipoResiduo = $this->input->post("tpResiduoFiltro");
		$dataLimite = $this->input->post("dataLimiteFiltro");
		$pesoResiduo = $this->input->post("pesoFiltro");
		
		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = '$cooperativa';
		
		$coopController = new \App\Models\TopicoModel();
		$registros = $coopController
		->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
		->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
		->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
		->where('dataLimite_topico >= CURRENT_DATE() AND dataLimite_topico ='. $dataLimite . ' AND tb_tpresiduos.id_tpResiduo ='. $tipoResiduo.' AND tb_residuostopico.quant_residuo ='. $pesoResiduo)
		->findAll();

		$data['topicos'] = $registros;
		
		var_dump($registros);
		//return view('cooperativas/pesquisartopicos/index', $data);
		
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
