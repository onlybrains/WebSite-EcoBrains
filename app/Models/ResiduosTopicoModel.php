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
}
