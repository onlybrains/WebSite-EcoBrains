<?php

namespace App\Controllers;

use App\Models\EmpresaModel;

class EmpresaController extends BaseController
{
  public function empresas()
  {
    $modelEmpresas = new \App\Models\EmpresaModel();
    $topicoModel = new \App\Models\TopicoModel();

    $Empresa = $modelEmpresas
      ->select('id_empresa, nomeFantasia_dados, razaoSoc_dados')
      ->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
      ->where('id_login', session()->get('id_login'))->first();

    $registros = $topicoModel
      ->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
      ->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
      ->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
      ->findAll();

    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = $Empresa->razaoSoc_dados;
    $data['topicos'] = $registros;

    return view('empresas/index', $data);
  }

  public function abrirTopico()
  {
    $modelEmpresas = new \App\Models\EmpresaModel();
    $tipoResiduosModel = new \App\Models\TipoResiduoModel();

    $Empresa = $modelEmpresas
      ->select('id_empresa, nomeFantasia_dados, razaoSoc_dados')
      ->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
      ->where('id_login', session()->get('id_login'))->first();

    $residuos = $tipoResiduosModel->find();

    if ($this->request->getMethod() === 'post') {
      $topicoModel = new \App\Models\TopicoModel();
      $modelEmpresa = new \App\Models\EmpresaModel();

      $Empresa = $modelEmpresa->where('id_login', session()->get('id_login'))->first();

      $topicoModel->set('titulo_topico', $this->request->getPost('titulo_topico'));
      $topicoModel->set('dataLimite_topico', $this->request->getPost('dataLimite_topico'));
      $topicoModel->set('id_empresa', $Empresa->id_empresa);

      $topicoModel->set('quant_residuo', $this->request->getPost('quant_residuo'));
      $topicoModel->set('id_tpResiduo', $this->request->getPost('id_tpResiduo'));

      if ($topicoModel->insert()) {
        $data['msg'] = "Tópico de Negociação Criado!";
      } else {
        $data['msg'] = $topicoModel->errors();
      }
    }

    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = $Empresa->razaoSoc_dados;
    $data['tpResiduos'] = $residuos;

    return view('empresas/abrir-topico/index', $data);
  }


  public function editarTopico($id_topico)
  {
    $modelEmpresas = new \App\Models\EmpresaModel();
    $topicoModel = new \App\Models\TopicoModel();
    $residuosTopicoModel = new \App\Models\ResiduosTopicoModel();
    $tipoResiduosModel = new \App\Models\TipoResiduoModel();

    $Empresa = $modelEmpresas
      ->select('id_empresa, nomeFantasia_dados, razaoSoc_dados')
      ->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
      ->where('id_login', session()->get('id_login'))->first();

    $topicoDadosModel = $topicoModel
      ->where('id_topico = ' . $id_topico)
      ->findAll();

    $topicoDadosResiduos = $residuosTopicoModel
      ->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
      ->where("id_topico = '{$id_topico}'")
      ->findAll();

    $residuos = $tipoResiduosModel->find();

    if ($this->request->getMethod() === 'post') {

      $topicoModel->titulo_topico = $this->request->getPost('titulo_topico');
      $topicoModel->dataLimite_topico = $this->request->getPost('dataLimite_topico');

      $topicoModel->quant_residuo = $this->request->getPost('quant_residuo');
      $topicoModel->id_tpResiduo = $this->request->getPost('id_tpResiduo');
    }

    $data['dados'] = $topicoDadosModel;
    $data['dadosResiduos'] = $topicoDadosResiduos;
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = $Empresa->razaoSoc_dados;
    $data['tpResiduos'] = $residuos;

    return view('empresas/editar-topico/index', $data);
  }

  public function viewTopico()
  {
    $modelEmpresas = new \App\Models\EmpresaModel();
    $topicoModel = new \App\Models\TopicoModel();

    $Empresa = $modelEmpresas
      ->select('id_empresa, nomeFantasia_dados, razaoSoc_dados')
      ->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
      ->where('id_login', session()->get('id_login'))->first();

    $registros = $topicoModel
      ->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
      ->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
      ->join('tb_interessetopico', 'tb_interessetopico.id_topico = tb_topico.id_topico')
      ->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
      ->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
      ->findAll();


    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = $Empresa->razaoSoc_dados;
    $data['registros'] = $registros;

    return view('empresas/view-topico/index', $data);
  }
}
