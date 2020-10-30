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

  protected $afterInsert = ['afterInsert'];

  protected $validationRules = [
    'titulo_topico'    =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'dataLimite_topico'         =>
    'required|min_length[8]|max_length[10]',

    'id_empresa'         =>
    'min_length[1]|max_length[1]',
  ];

  protected function afterInsert(array $data)
  { 
    // var_dump($data);
    $residuosTopicoModel = new \App\Models\ResiduosTopicoModel();
    $residuosTopicoModel->set('id_topico', '10' );
    $residuosTopicoModel->set('quant_residuo', '100' );
    $residuosTopicoModel->set('id_tpResiduo', '2' );

    $residuosTopicoModel->insert();
    
  }

}
