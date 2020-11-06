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


  protected $validationRules = [
    'info_desc'        =>
    'string',

    'logo_desc'    =>
    'is_image[inputLogo]',

    'banner_desc'         =>
    'is_image[inputBanner]',

    'tempoMercado_desc'      =>
    'min_length[8]|max_length[10]',

    'site_desc'         =>
    'valid_url',
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
