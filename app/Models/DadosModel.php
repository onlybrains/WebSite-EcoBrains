<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DescModel;
use App\Models\EmpresaModel;
use App\Models\CoopModel;


class DadosModel extends Model
{
  protected $table      = 'tb_dados';
  protected $primaryKey = 'id_dados';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'nomeFantasia_dados',
    'razaoSoc_dados',
    'cnpj_dados',
    'cep_dados',
    'numEnd_dados',
    'tel_dados',
    'whatsapp_dados',
    'complemento_dados',
  ];

  protected $afterInsert = ['afterInsert'];

  protected $validationRules = [
    'inputTipo'        =>
    'required',

    'cnpj_dados'        =>
    'required|min_length[14]|is_unique[tb_dados.cnpj_dados]',

    'nomeFantasia_dados'    =>
    'required|string|min_length[5]|max_length[100]',

    'razaoSoc_dados'       =>
    'required|string|min_length[5]|max_length[100]',

    'cep_dados'         =>
    'required|min_length[8]',

    'numEnd_dados'      =>
    'required|alpha_numeric|greater_than[0]|max_length[5]',

    'complemento_dados' =>
    'string|max_length[10]',

    'inputEnd'         =>
    'min_length[13]',

    'tel_dados'         =>
    'min_length[10]',

    'whatsapp_dados'         =>
    'min_length[11]',
  ];

  protected $validationMessages = [
    'inputTipo'        =>
    [
      'required' => 'O campo Tipo deve ser preenchido.'
    ],

    'cnpj_dados'        =>
    [
      'required' => 'O campo CNPJ deve ser preenchido.',
      'min_length' => 'O campo CNPJ deve conter no mínimo 14 caracteres.',
      'is_unique' => 'O campo CNPJ já existe.'
    ],

    'nomeFantasia_dados'    =>
    [
      'required' => 'O campo Nome Fantasia deve ser preenchido.',
      'string' => 'O campo Nome Fantasia deve ser um texto.',
      'min_length' => 'O campo Nome Fantasia deve conter no mínimo 5 caracteres.',
      'max_length' => 'O campo Nome Fantasia deve conter no máximo 100 caracteres.',
    ],

    'razaoSoc_dados'       =>
    [
      'required' => 'O campo Razão Social deve ser preenchido.',
      'string' => 'O campo Razão Social deve ser um texto.',
      'min_length' => 'O campo Razão Social deve conter no mínimo 5 caracteres.',
      'max_length' => 'O campo Nome Fantasia deve conter no máximo 100 caracteres.',
    ],

    'cep_dados'         =>
    [
      'required' => 'O campo CEP deve ser preenchido.',
      'min_length' => 'O campo CEP deve conter no mínimo 8 caracteres.',
    ],

    'numEnd_dados'      =>
    [
      'required' => 'O campo Número deve ser preenchido.',
      'alpha_numeric' => 'O campo Número pode contar apenas caracteres alfanuméricos.',
      'greater_than' => 'O campo Número deve ser preenchido.',
      'max_length' => 'O campo Número deve conter no mínimo 5 caracteres.',
    ],

    'complemento_dados' =>
    [
      'string' => 'O campo Complemento deve ser um texto.',
      'max_length' => 'O campo Complemento conter no máximo 10 caracteres.',
    ],

    'inputEnd'         =>
    [
      'min_length' => 'O campo Endereço deve conter no mínimo 13 caracteres.',
    ],

    'tel_dados'         =>
    [
      'min_length' => 'O campo Telefone deve conter no mínimo 10 caracteres.',
    ],

    'whatsapp_dados'         =>
    [
      'min_length' => 'O campo WhatsApp deve conter no mínimo 10 caracteres.',
    ],

  ];

  protected function afterInsert($data)
  {
    $model = new DescModel();
    $id_desc = $model->skipValidation()->insert(['info_desc' => null]);

    if (session()->getFlashdata('inputTipo') == 'empresa') {
      $model = new EmpresaModel();
    } else {
      $model = new CoopModel();
    }

    $dataInsert = [
      'id_dados' => $data['id'],
      'id_desc' => $id_desc,
      'id_login' => session()->get('id_login')
    ];
    $model->insert($dataInsert);
  }
}
