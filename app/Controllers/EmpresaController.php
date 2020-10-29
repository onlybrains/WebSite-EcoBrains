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

    $data['tpresiduos'] = $residuos;

    //INSERIR NAS TABELAS
    if ($this->request->getMethod() === 'post') {
      $topicoController = new \App\Models\TopicoModel();
      $residuosController = new \App\Models\ResiduosTopicoModel();

      //TB_TOPICO
      $topicoController->set('titulo_topico', $this->request->getPost('titulo_topico'));
      $topicoController->set('dataLimite_topico', $this->request->getPost('dataLimite_topico'));
      $topicoController->set('id_empresa', $this->request->getPost($_SESSION['id_empresa']));

      //TB_RESIDUOSTOPICO
      $residuosController->set('quant_residuo', $this->request->getPost('quant_residuo'));
      $residuosController->set('id_tpResiduo', $this->request->getPost('id_tpResiduo'));
      $residuosController->set('id_topico', $this->request->getPost('')); //<- PRECISA DESCOBRIR COMO COLOCA ESSA MERDA 

      if ($topicoController->insert() && $residuosController->insert()) {
        $data['msg'] = "Tópico de Negociação Criado!";
      } else {
        $data['msg'] = "Erro ao criar o Tópico...";
      }
    }

    // var_dump($data);
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
