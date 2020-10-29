<?php namespace App\Models;

use CodeIgniter\Model;

class InteresseTopicoModel extends Model{
    
    protected $table = 'tb_interessetopico';
    protected $primaryKey = 'id_interesseTopico';
    protected $allowedFields = ['aprov_interesseTopico', 'id_topico', 'id_coop'];
    protected $returnType = 'object';

    protected $beforeInsert = ['beforeInsert'];

    protected $validationRules = [
        'aprov_interesseTopico'   =>
        'required|max_length[1]|integer|',

        'id_topico'   =>
        'required|max_length[1]|integer',

        'id_coop'   =>
        'required|max_length[1]|integer',
    ];

    protected function beforeInsert(array $data)
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
    }
}
?>