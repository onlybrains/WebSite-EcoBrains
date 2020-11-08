<?php

namespace App\Models;

use CodeIgniter\Model;


class ColetaSeletivaModel extends Model
{
  protected $table      = 'tb_coletaSeletiva';
  protected $primaryKey = 'id_coletaSeletiva';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'estado_coletaSeletiva',
    'cidade_coletaSeletiva',
    'bairro_coletaSeletiva',
    'diasSemana_coletaSeletiva',
  ];
}
