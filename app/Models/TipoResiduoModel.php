<?php namespace App\Models;

use CodeIgniter\Model;

class TipoResiduoModel extends Model{

  protected $table = 'tb_tpresiduos';
  protected $primaryKey = 'id_tpResiduo';
  protected $allowedFields = ['nome_tpResiduo'];
  protected $returnType = 'object';

}

?>