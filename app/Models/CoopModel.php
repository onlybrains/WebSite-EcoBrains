<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DescModel;


class CoopModel extends Model
{
  protected $table      = 'tb_cooperativas';
  protected $primaryKey = 'id_coop';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'nomeFantasia_coop',
    'razaoSoc_coop',
    'cnpj_coop',
    'cep_coop',
    'numEnd_coop',
    'tel_coop',
    'whatsapp_coop',
    'id_login',
    'id_desc',
    'complemento_coop',
  ];

  protected $beforeInsert = ['beforeInsert'];
  // protected $beforeUpdate = ['hashPassword'];

  protected $validationRules = [
    'inputTipo'        =>
    'required',

    'cnpj_coop'        =>
    'required|min_length[14]|is_unique[tb_cooperativas.cnpj_coop]',

    'nomeFantasia_coop'    =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'razaoSoc_coop'       =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'cep_coop'         =>
    'required|min_length[8]',

    'numEnd_coop'      =>
    'required|alpha_numeric|greater_than[0]|max_length[5]',

    'complemento_coop' =>
    'alpha_numeric_space|max_length[10]',

    'inputEnd'         =>
    'min_length[13]',

    'tel_coop'         =>
    'min_length[10]',

    'whatsapp_coop'         =>
    'min_length[11]',
  ];

  // protected $validationMessages = [
  //   'inputTipo'             => [
  //     'required'            => 'O campo tipo deve ser preenchido',
  //   ],
  //   'cnpj_coop'             => [
  //     'required'            => 'O campo CNPJ deve ser preenchido',
  //     'min_length'          => 'O campo CNPJ deve ser preenchido por completo',
  //     'is_unique'           => 'CNPJ já cadastrado',
  //   ],
  //   'nomeFantasia_coop'         => [
  //     'required'            => 'O campo nome fantasia deve ser preenchido',
  //     'alpha_numeric_space' => 'O campo nome fantasia deve ser preenchido por números e letras',
  //     'min_length'          => 'O campo nome fantasia deve ter no mínimo 5 caracteres',
  //     'max_length'          => 'O campo nome fantasia deve ter no máximo 100 caracteres',
  //   ],
  //   'razaoSoc_coop'            => [
  //     'required'            => 'O campo razão social deve ser preenchido',
  //     'alpha_numeric_space' => 'O campo razão social deve ser preenchido por números e letras',
  //     'min_length'          => 'O campo razão social deve ter no mínimo 5 caracteres',
  //     'max_length'          => 'O campo razão social deve ter no máximo 100 caracteres',
  //   ],
  //   'cep_coop'              => [
  //     'required'            => 'O campo CEP deve ser preenchido',
  //     'min_length'          => 'O campo CEP deve ter no mínimo 8',
  //   ],
  //   'numEnd_coop'           => [
  //     'required'            => 'O campo número deve ser preenchido',
  //     'alpha_numeric'       => 'O campo número deve ser preenchido por números',
  //     'greater_than'        => 'O campo número deve ser maior que 0',
  //     'max_length'          => 'O campo número deve ter no máximo 5 caracteres',
  //   ],
  //   'complemento_coop'      => [
  //     'alpha_numeric_space' => 'O campo número deve ser preenchido por números e letras',
  //     'max_length'          => 'O campo número deve ter no máximo 10 caracteres',
  //   ],
  //   'inputEnd'      => [
  //     'min_length'          => 'Digite um CEP valído',
  //   ],
  //   'tel_coop'      => [
  //     'min_length'          => 'Telefone deve conter no mínimo 10 números',
  //   ],
  //   'whatsapp_coop'      => [
  //     'min_length'          => 'Telefone deve conter no mínimo 11 números',
  //   ],
  // ];



  protected function beforeInsert(array $data)
  {
    $model = new DescModel();

    $id_desc = $model->insert(['info_desc' => null]);

    $data['data']['id_desc'] = strval($id_desc);
    $data['data']['id_login'] = session()->get('id_login');

    return $data;
  }
}
