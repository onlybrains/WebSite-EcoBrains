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
