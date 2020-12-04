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

  protected $validationMessage = [
    'info_desc'        =>
    [
      'string' => 'O campo Descrição deve ser um texto.',
    ],

    'logo_desc'    =>
    [
      'is_image' => 'O Logo deve ser uma imagem.',
    ],

    'banner_desc'         =>
    [
      'is_image' => 'O Banner deve ser uma imagem.',
    ],

    'tempoMercado_desc'      =>
    [
      'min_length[8]' => 'O campo Tempo de Mercado deve conter no mínimo 8 caracteres.',
      'max_length[10]' => 'O campo Tempo de Mercado deve conter no máximo 10 caracteres.',
    ],

    'site_desc'         =>
    [
      'valid_url' => 'O campo Site deve ser válido',
    ],
  ];

  protected $afterInsert = ['afterInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  protected function beforeUpdate(array $data)
  {
    $banner = $data['data']['banner_desc'];
    $logo = $data['data']['logo_desc'];

    if ($banner->isValid() && !$banner->hasMoved()) {
      $newName = $banner->getRandomName();
      $banner->move('./uploads/images', $newName);

      $path = 'uploads/images/' . $banner->getName();
      $data['data']['banner_desc'] = $path;
    } else
      unset($data['data']['banner_desc']);


    if ($logo->isValid() && !$logo->hasMoved()) {
      $newName = $logo->getRandomName();
      $logo->move('./uploads/images', $newName);

      $path = 'uploads/images/' . $logo->getName();
      $data['data']['logo_desc'] = $path;
    } else
      unset($data['data']['logo_desc']);

    return $data;
  }


  protected function afterInsert(array $data)
  {
    if ($data['id'] > 0) {
      $session = \Config\Services::session();
      $session->setFlashdata('id_desc', $data['id']);
    }
    return $data;
  }
}
