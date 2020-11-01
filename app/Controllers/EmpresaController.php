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

    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = $Empresa->razaoSoc_dados;

    $residuos = $tipoResiduosModel->find();
    $data['tpResiduos'] = $residuos;

    if ($this->request->getMethod() === 'post') {
      $residuosTopicoModel = new \App\Models\ResiduosTopicoModel();
      $topicoModel = new \App\Models\TopicoModel();
      $modelEmpresa = new \App\Models\EmpresaModel();

      $Empresa = $modelEmpresa->where('id_login', session()->get('id_login'))->first();

      $topicoModel->set('titulo_topico', $this->request->getPost('titulo_topico'));
      $topicoModel->set('dataLimite_topico', $this->request->getPost('dataLimite_topico'));
      $topicoModel->set('id_empresa', $Empresa->id_empresa);

      $residuosTopicoModel->set('quant_residuo', $this->request->getPost('quant_residuo'));
      $residuosTopicoModel->set('id_tpResiduo', $this->request->getPost('id_tpResiduo'));

      if ($topicoModel->insert()) {
        $residuosTopicoModel->set('id_topico', $topicoModel->getInsertID());
        if ($residuosTopicoModel->insert()) {
          return redirect()->to('/empresas');
        } else {
          $data['errors'] = $residuosTopicoModel->errors();
          $topicoModel->delete($topicoModel->getInsertID());
        }
      } else {
        $data['errors'] = $topicoModel->errors();
      }
    }
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

    $topicos = $topicoModel
      ->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
      ->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
      ->where('tb_topico.id_topico', $id_topico)->first();

    $residuos = $tipoResiduosModel->find();

    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = $Empresa->razaoSoc_dados;
    $data['tpResiduos'] = $residuos;
    $data['topicos'] = $topicos;


    if ($this->request->getMethod() === 'post') {

      $topicoModel->set('titulo_topico', $this->request->getPost('titulo_topico'));
      $topicoModel->set('dataLimite_topico', $this->request->getPost('dataLimite_topico'));

      $residuosTopicoModel->set('quant_residuo', $this->request->getPost('quant_residuo'));
      $residuosTopicoModel->set('id_tpResiduo', $this->request->getPost('id_tpResiduo'));

      if ($topicoModel->update($id_topico)) {

        if ($residuosTopicoModel->update($topicos->id_residuo)) {
          return redirect()->to('/empresas');
        } else {
          $data['errors'] = $residuosTopicoModel->errors();
        }
      } else {
        $data['errors'] = $topicoModel->errors();
      }
    }
    return view('empresas/editar-topico/index', $data);
  }

  public function deletarTopico($id_topico)
  {

    $topicoModel = new \App\Models\TopicoModel();

    $topicoModel
    ->where('id_topico', $id_topico)
    ->delete();

    return redirect()->to(base_url('empresas'));
  }

  public function viewTopico($id_topico)
  {
    $modelEmpresas = new \App\Models\EmpresaModel();
    $topicoModel = new \App\Models\TopicoModel();

    $Empresa = $modelEmpresas
      ->select('id_empresa, nomeFantasia_dados, razaoSoc_dados')
      ->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
      ->where('id_login', session()->get('id_login'))->first();

    $topicosDadosEmpresa = $topicoModel
      ->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
      ->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
      ->where('tb_topico.id_topico', $id_topico)->first();

    $registrosInteresseCooperativa = $topicoModel
      ->join('tb_interessetopico', 'tb_interessetopico.id_topico = tb_topico.id_topico')
      ->join('tb_residuostopico', 'tb_residuostopico.id_topico = tb_topico.id_topico')
      ->join('tb_tpresiduos', 'tb_tpresiduos.id_tpResiduo = tb_residuostopico.id_tpResiduo')
      ->join('tb_cooperativas', 'tb_cooperativas.id_coop = tb_interessetopico.id_coop')
      ->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
      ->where("tb_topico.id_topico= '{$id_topico}'")
      ->findAll();

    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = $Empresa->razaoSoc_dados;
    $data['registroEmpresa'] = $topicosDadosEmpresa;
    $data['registrosInteresseCooperativa'] = $registrosInteresseCooperativa;

    return view('empresas/view-topico/index', $data);
  }
}
