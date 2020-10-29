<?php namespace App\Models;

use CodeIgniter\Model;

class ResiduosTopicoModel extends Model{

  protected $table = 'tb_residuostopico';
  protected $primaryKey = 'id_residuo';
  protected $allowedFields = ['quant_residuo, id_tpResiduo, id_topico'];
  protected $returnType = 'object';

}

?>