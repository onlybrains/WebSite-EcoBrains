<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DescModel;

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

  protected $validationRules = [
    'titulo_topico'    =>
    'required|string|min_length[5]|max_length[100]',

    'dataLimite_topico'         =>
    'required|min_length[8]|max_length[10]',
  ];

  protected $validationMessages = [
    'titulo_topico'      =>
    [
      'required' => 'O campo título deve ser preenchido.',
      'string' => 'O campo título deve ser um texto.',
      'min_length' => 'O campo título deve ter no mínimo 5 caracteres.',
      'max_length' => 'O campo título deve ter no máximo 100 caracteres.'
    ],
    
    'dataLimite_topico'       =>   [
      'required' => 'O campo data limite deve ser preenchido.',
      'min_length' => 'O campo data limite deve ter no mínimo 8 caracteres.',
      'max_length' => 'O campo data limite deve ter no máximo 10 caracteres.'
    ],
  ];

}
