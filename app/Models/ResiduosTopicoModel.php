<?php namespace App\Models;

use CodeIgniter\Model;

class ResiduosTopicoModel extends Model{

  protected $table = 'tb_residuosTopico';
  protected $primaryKey = 'id_residuo';
  protected $allowedFields = ['quant_residuo', 'id_tpResiduo', 'id_topico'];
  protected $returnType = 'object';

  protected $validationRules = [
    'quant_residuo'    =>
    'required|decimal|greater_than[0]',
  
    'id_tpResiduo'         =>
    'required',
    
    'id_topico'         =>
    'required',
  ];

  protected $validationMessages = [
    'quant_residuo'      =>
    [
      'required' => 'O campo quantidade de resíduo deve ser preenchido.',
      'decimal' => 'O campo quantidade de resíduo deve ser decimal.',
      'greater_than' => 'O campo quantidade de resíduo deve ser maior que 0.',
    ],
    
    'id_tpResiduo'       =>   [
      'required' => 'O campo id_tipoResiduo deve ser preenchido.',
    ],

    'id_topico'   =>
    [
      'required' => 'O campo id_topíco deve ser preenchido.',
    ],
  ];
}
