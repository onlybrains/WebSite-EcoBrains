<?php

namespace App\Controllers;

use App\Models\CoopModel;

class CoopController extends BaseController
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

		$coopController = new \App\Models\TipoResiduoModel();
		$registrosTipos = $coopController -> findAll();

		$data['topicos'] = $registros;
		$data['tipos'] = $registrosTipos;

		//var_dump($registrosTipos);
		return view('cooperativas/pesquisartopicos/index', $data);
	}

	// ARRUMAR //
	public function interesseTopico($id_topico, $id_coop = 1)
	{
		/* INTERESSE MOSTRADO — Falta apenas colocar para a inserir o valor da cooperativa que está logada */
		$coopController = new \App\Models\InteresseTopicoModel();
		$coopController
			->set('aprov_interesseTopico', '1')
			->set('id_topico', $id_topico)
			->set('id_coop', 1)
			->insert();

		/* QUERY PARA PEGAR O EMAIL DA EMPRESA */
		$topicoEmail = new \App\Models\TopicoModel();
		$topicoEmail
			->select('email_login')
			->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
			->join('tb_login', 'tb_login.id_login = tb_empresas.id_login')
			->where('id_topico = ' . $id_topico)
			->findAll();


		//var_dump($topicoEmail);

		return redirect()->to(base_url('cooperativas'));
	}

	// ARRUMAR A ROTA NA VIEW
	public function pesquisafiltro()
	{
		$tipoResiduo = $this->request->getPost("tpResiduoFiltro");
		$dataLimite = $this->request->getPost("dataLimiteFiltro");
		$pesoResiduo = $this->request->getPost("pesoFiltro");

		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = '$cooperativa';

		$coopController = new \App\Models\TopicoModel();
		$registros = $coopController
			->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
			->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
			->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
			->where("dataLimite_topico >= CURRENT_DATE() AND dataLimite_topico <='{$dataLimite}' AND nome_tpResiduo ='{$tipoResiduo}' AND quant_residuo <= '{$pesoResiduo}'")
			//" AND nome_tpResiduo = 'Madeira' AND quant_residuo <= '450'")
			->findAll();
			
		$coopController = new \App\Models\TipoResiduoModel();
		$registrosTipos = $coopController -> findAll();
	
		$data['topicos'] = $registros;
		$data['tipos'] = $registrosTipos;

		//echo "<pre>";
		//var_dump($dataLimite, $pesoResiduo, $tipoResiduo);
		return view('cooperativas/pesquisartopicos/index', $data);

	}

	public function pesquisarempresas()
	{
		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = '$cooperativa';

		$coopController = new \App\Models\EmpresaModel();
		$registros = $coopController->find();

		$data['empresas'] = $registros;

		return view('cooperativas/pesquisarempresas/index', $data);
	}
}
