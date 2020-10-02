<?php

namespace App\Models;

use CodeIgniter\Model;

class DescModel extends Model
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

  protected $afterInsert = ['afterInsert'];


  protected function afterInsert(array $data)
  {
    if ($data['id'] > 0) {
      $session = \Config\Services::session();
      $session->setFlashdata('id_desc', $data['id']);
    }
    return $data;
  }
}
