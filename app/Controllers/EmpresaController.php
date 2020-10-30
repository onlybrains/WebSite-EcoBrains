<?php

namespace App\Controllers;

use App\Models\EmpresaModel;

class EmpresaController extends BaseController
{
  public function empresas()
  {
    // $modelDados = new \App\Models\DadosModel();
    // $nomeEmpresa = $modelDados
    //  ->select('nomeFantasia_dados')
    //  ->findAll();

    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = '$nomeEmpresa';

    // var_dump($nomeEmpresa);
    return view('empresas/index', $data);
  }
  //*CRIAR TÓPICO DE NEGOCIAÇÃO*//
  public function abrirTopico()
  {
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

    //LISTAR OS TIPO DE RESÍDUOS PARA INSERIR OS DADOS
    $tipoResiduosModel = new \App\Models\TipoResiduoModel();
    $residuos = $tipoResiduosModel->find();

    $data['tpResiduos'] = $residuos;

    //INSERIR NAS TABELAS
    if ($this->request->getMethod() === 'post') {
      $topicoModel = new \App\Models\TopicoModel();
      // $residuosTopicoModel = new \App\Models\ResiduosTopicoModel();
      $modelEmpresa = new \App\Models\EmpresaModel();

      $Empresa = $modelEmpresa->where('id_login', session()->get('id_login'))->first();
      //TB_TOPICO
      $topicoModel->set('titulo_topico', $this->request->getPost('titulo_topico'));
      $topicoModel->set('dataLimite_topico', $this->request->getPost('dataLimite_topico'));
      $topicoModel->set('id_empresa', $Empresa->id_empresa);

      $topicoModel->set('quant_residuo', $this->request->getPost('quant_residuo'));
      $topicoModel->set('id_tpResiduo', $this->request->getPost('id_tpResiduo'));

      if ($topicoModel->insert()) {

        // var_dump($topicoController->getInsertID());
        //TB_RESIDUOSTOPICO

        // $residuosTopicoModel->set('id_topico', $topicoController->getInsertID());

        // $insertResiduos = [
        //   'quant_residuo' => ('700'),
        //   'id_tpResiduo'=> ('1'),
        //   'id_topico'=> ('15'),
        // ];

        // $residuosTopicoModel->insert($insertResiduos);

        $data['msg'] = "Tópico de Negociação Criado!";
      } else {
        $data['msg'] = $topicoModel->errors();
      }
    }

    return view('empresas/abrir-topico/index', $data);
  }

  //*ATUALIZAR TÓPICO DE NEGOCIAÇÃO*//
  public function editarTopico()
  {
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

    $topicoModel = new \App\Models\TopicoModel();
    $topicoDadosModel = $topicoModel
    ->where('id_topico = 10')
    ->findAll();

    $residuosTopicoModel = new \App\Models\ResiduosTopicoModel();
    $topicoDadosResiduos = $residuosTopicoModel
    ->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
    ->where('id_topico = 10')
    ->findAll();


    if ($this->request->getMethod() === 'post') {

      $topicoModel->titulo_topico = $this->request->getPost('titulo_topico');
      $topicoModel->dataLimite_topico = $this->request->getPost('dataLimite_topico');

      $topicoModel->quant_residuo = $this->request->getPost('quant_residuo');
      $topicoModel->id_tpResiduo = $this->request->getPost('id_tpResiduo');
    }

    $data['dados'] = $topicoDadosModel;
    $data['dadosResiduos'] = $topicoDadosResiduos;

    $tipoResiduosModel = new \App\Models\TipoResiduoModel();
    $residuos = $tipoResiduosModel->find();

    $data['tpResiduos'] = $residuos;

    // var_dump($topicoDadosModel);
    // var_dump($topicoDadosResiduos);
    return view('empresas/editar-topico/index', $data);
  }

    //*LISTAR TÓPICO DE NEGOCIAÇÃO*//
  public function viewTopico()
  {
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

    $coopController = new \App\Models\TopicoModel();
		$registros = $coopController
			->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
			->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
			->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
			->findAll();

		$data['topicos'] = $registros;

    return view('empresas/view-topico/index', $data);
  }
}
