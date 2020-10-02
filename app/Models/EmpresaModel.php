<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DescModel;


class EmpresaModel extends Model
{
  protected $table      = 'tb_empresas';
  protected $primaryKey = 'id_empresa';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'nomeFantasia_empresa',
    'razaoSoc_empresa',
    'cnpj_empresa',
    'cep_empresa',
    'numEnd_empresa',
    'tel_empresa',
    'whatsapp_empresa',
    'id_login',
    'id_desc',
  ];

  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['hashPassword'];

  protected $afterInsert = ['afterInsert'];




  protected function beforeInsert(array $data)
  {
    var_dump($data['data']);
    //tirar mask CNPJ
    if (isset($data['data']['cnpj_empresa'])) {
      $data['data']['cnpj_empresa'] = onlyNumbers($data['data']['cnpj_empresa']);
    }

    //tirar mask CEP
    if (isset($data['data']['cep_empresa'])) {
      $data['data']['cep_empresa'] = onlyNumbers($data['data']['cep_empresa']);
    }

    //tirar mask TEL
    if (isset($data['data']['tel_empresa'])) {
      $data['data']['tel_empresa'] = onlyNumbers($data['data']['tel_empresa']);
    }

    //tirar mask WHATS
    if (isset($data['data']['whatsapp_empresa'])) {
      $data['data']['whatsapp_empresa'] = onlyNumbers($data['data']['whatsapp_empresa']);
    }

    $DescModel = new DescModel();

    $DescModel->insert(['info_desc' => 'Descrição']);

    $session = \Config\Services::session();


    $data['data']['id_desc'] = $session->get('id_desc');




    return $data;
  }


  protected function afterInsert(array $data)
  {
    $session = \Config\Services::session();
    $session->destroy();


    return $data;
  }
}

function onlyNumbers(string $value)
{
  return $value = preg_replace("/[^0-9]/", "", $value);
}
