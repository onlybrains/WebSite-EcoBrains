<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoResiduoModel extends Model
{

  protected $table = 'tb_tpResiduos';
  protected $primaryKey = 'id_tpResiduo';
  protected $allowedFields = ['nome_tpResiduo'];
  protected $returnType = 'object';

  protected $validationRules = [
    'nome_tpResiduo'   =>
    'required|min_length[1]|max_lenght[30]|integer|',
  ];

  protected $validationMessages = [
    'nome_tpResiduo'      =>
    [
      'required' => 'O campo tipo do resíduo deve ser preenchido.',
      'min_length' => 'O campo tipo do resíduo deve ter no mínimo 1 caracteres.',
      'max_length' => 'O campo tipo do resíduo deve ter no máximo 30 caracteres.',
      'integer' => 'O campo tipo do resíduo deve ser inteiro.',
    ],

  ];
}
