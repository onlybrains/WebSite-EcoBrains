<?php

namespace App\Models;

use CodeIgniter\Model;

class UpdateDescModel extends Model
{
  protected $table      = 'tb_desc';
  protected $primaryKey = 'id_desc';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'info_desc',
    'logo_desc',
    'banner_desc',
    'tempoMercado_desc',
    'site_desc',
    'premium_desc',
  ];
}
