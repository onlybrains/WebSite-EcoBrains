<?php

namespace App\Models;

use CodeIgniter\Model;


class EmpresaModel extends Model
{
  protected $table      = 'tb_empresas';
  protected $primaryKey = 'id_empresa';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'id_login',
    'id_desc',
    'id_dados',
  ];
}
