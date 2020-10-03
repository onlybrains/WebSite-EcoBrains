<?php

namespace App\Models;

use CodeIgniter\Model;
// use App\Models\DescModel;


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
    'complemento_empresa',
  ];

  // protected $beforeInsert = ['beforeInsert'];
  // protected $beforeUpdate = ['hashPassword'];
  // protected $afterInsert = ['afterInsert'];

  protected $validationRules = [
    'inputTipo'        =>
    'required',

    'cnpj_empresa'        =>
    'required|min_length[14]|is_unique[tb_empresas.cnpj_empresa]',

    'nomeFantasia_empresa'    =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'razaoSoc_empresa'       =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'cep_empresa'         =>
    'required|min_length[8]',

    'numEnd_empresa'      =>
    'required|alpha_numeric|greater_than[0]|max_length[5]',

    'complemento_empresa' =>
    'alpha_numeric_space|max_length[10]',

    'inputEnd'         =>
    'min_length[13]',

    'tel_empresa'         =>
    'min_length[10]',

    'whatsapp_empresa'         =>
    'min_length[11]',
  ];

  // protected $validationMessages = [
  //   'inputTipo'             => [
  //     'required'            => 'O campo tipo deve ser preenchido',
  //   ],
  //   'cnpj_empresa'             => [
  //     'required'            => 'O campo CNPJ deve ser preenchido',
  //     'min_length'          => 'O campo CNPJ deve ser preenchido por completo',
  //     'is_unique'           => 'CNPJ já cadastrado',
  //   ],
  //   'nomeFantasia_empresa'         => [
  //     'required'            => 'O campo nome fantasia deve ser preenchido',
  //     'alpha_numeric_space' => 'O campo nome fantasia deve ser preenchido por números e letras',
  //     'min_length'          => 'O campo nome fantasia deve ter no mínimo 5 caracteres',
  //     'max_length'          => 'O campo nome fantasia deve ter no máximo 100 caracteres',
  //   ],
  //   'razaoSoc_empresa'            => [
  //     'required'            => 'O campo razão social deve ser preenchido',
  //     'alpha_numeric_space' => 'O campo razão social deve ser preenchido por números e letras',
  //     'min_length'          => 'O campo razão social deve ter no mínimo 5 caracteres',
  //     'max_length'          => 'O campo razão social deve ter no máximo 100 caracteres',
  //   ],
  //   'cep_empresa'              => [
  //     'required'            => 'O campo CEP deve ser preenchido',
  //     'min_length'          => 'O campo CEP deve ter no mínimo 8',
  //   ],
  //   'numEnd_empresa'           => [
  //     'required'            => 'O campo número deve ser preenchido',
  //     'alpha_numeric'       => 'O campo número deve ser preenchido por números',
  //     'greater_than'        => 'O campo número deve ser maior que 0',
  //     'max_length'          => 'O campo número deve ter no máximo 5 caracteres',
  //   ],
  //   'complemento_empresa'      => [
  //     'alpha_numeric_space' => 'O campo número deve ser preenchido por números e letras',
  //     'max_length'          => 'O campo número deve ter no máximo 10 caracteres',
  //   ],
  //   'inputEnd'      => [
  //     'min_length'          => 'Digite um CEP valído',
  //   ],
  //   'tel_empresa'      => [
  //     'min_length'          => 'Telefone deve conter no mínimo 10 números',
  //   ],
  //   'whatsapp_empresa'      => [
  //     'min_length'          => 'Telefone deve conter no mínimo 11 números',
  //   ],
  // ];



  // protected function beforeInsert(array $data)
  // {

  //   $DescModel = new DescModel();

  //   $id_desc = $DescModel->insert(['info_desc' => 'Descrição']);

  //   $data['data']['id_desc'] = $id_desc;


  //   return $data;
  // }


  // protected function afterInsert(array $data)
  // {
  //   return $data;
  // }
}
