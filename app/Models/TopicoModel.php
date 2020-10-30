<?php

namespace App\Models;

use CodeIgniter\Model;

class TopicoModel extends Model
{
  protected $table      = 'tb_topico';
  protected $primaryKey = 'id_topico';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'titulo_topico',
    'dataLimite_topico',
    'id_empresa',
  ];
}
