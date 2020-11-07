<?php

namespace App\Models;

use CodeIgniter\Model;


class CoopModel extends Model
{
  protected $table      = 'tb_cooperativas';
  protected $primaryKey = 'id_coop';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'id_login',
    'id_desc',
    'id_dados',
  ];
}
