<?php

namespace App\Models;

use CodeIgniter\Model;

class UpdateDadosModel extends Model
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

  protected $validationRules = [
    'cnpj_dados'        =>
    'required|min_length[14]|is_unique[tb_dados.cnpj_dados,cnpj_dados,cnpj_dados]',

    'nomeFantasia_dados'    =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'razaoSoc_dados'       =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'cep_dados'         =>
    'required|min_length[8]',

    'numEnd_dados'      =>
    'required|alpha_numeric|greater_than[0]|max_length[5]',

    'complemento_dados' =>
    'alpha_numeric_space|max_length[10]',

    'inputEnd'         =>
    'min_length[13]',

    'tel_dados'         =>
    'min_length[10]',

    'whatsapp_dados'         =>
    'min_length[11]',
  ];
}
