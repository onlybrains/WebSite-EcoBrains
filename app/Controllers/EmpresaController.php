<?php

namespace App\Controllers;

use App\Models\EmpresaModel;

class EmpresaController extends BaseController
{
  public function empresas()
  {
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = '$empresa';

    return view('empresas/index', $data);
  }
  //*CRIAR TÓPICO DE NEGOCIAÇÃO*//
  public function abrirTopico()
  {
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

    //LISTAR OS TIPO DE RESÍDUOS PARA INSERIR OS DADOS
    $tipoResiduosController = new \App\Models\TipoResiduoModel();
    $residuos = $tipoResiduosController->find();

    $data['tpResiduos'] = $residuos;

    //INSERIR NAS TABELAS
    if ($this->request->getMethod() === 'post') {
      $topicoController = new \App\Models\TopicoModel();
      // $residuosTopicoModel = new \App\Models\ResiduosTopicoModel();
      $modelEmpresa = new \App\Models\EmpresaModel();

      $Empresa = $modelEmpresa->where('id_login', session()->get('id_login'))->first();
      //TB_TOPICO
      $topicoController->set('titulo_topico', $this->request->getPost('titulo_topico'));
      $topicoController->set('dataLimite_topico', $this->request->getPost('dataLimite_topico'));
      $topicoController->set('id_empresa', $Empresa->id_empresa);

      $topicoController->set('quant_residuo', $this->request->getPost('quant_residuo'));
      $topicoController->set('id_tpResiduo', $this->request->getPost('id_tpResiduo'));

      if ($topicoController->insert()) {

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
        $data['msg'] = $topicoController->errors();
      }
    }

    return view('empresas/abrir-topico/index', $data);
  }

  public function editarTopico()
  {
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

    return view('empresas/editar-topico/index', $data);
  }

  public function viewTopico()
  {
    $data['titulo'] = 'Pesquisar Cooperativas';
    $data['nome'] = 'Nome da Empresa';

    return view('empresas/view-topico/index', $data);
  }
}
