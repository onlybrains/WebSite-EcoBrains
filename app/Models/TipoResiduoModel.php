<?php namespace App\Models;

use CodeIgniter\Model;

class TipoResiduoModel extends Model{
    
    protected $table = 'tb_tpresiduos';
    protected $primaryKey = 'id_tpResiduo';
    protected $allowedFields = ['nome_tpResiduo'];
    protected $returnType = 'object';

    //protected $beforeInsert = ['beforeInsert'];

    protected $validationRules = [
        'nome_tpResiduo'   =>
        'required|min_length[1]|max_lenght[30]|integer|',
    ];

    /*protected function beforeInsert(array $data)
    {
      $modelTopico = new TopicoModel();

      $id_topico = "";
  
      $data['data']['id_topico'] = $id_topico;
      $modelTopico->find('id_topico');

      $id_coop = "";

      $modelCooperativa = new CoopModel();

      $data['data']['id_coop'] = $id_coop;
      $modelCooperativa->find('id_topico');
  
      return $data;
    }*/
}
?>