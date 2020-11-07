<?php namespace App\Models;

use CodeIgniter\Model;

class InteresseTopicoModel extends Model{
    
    protected $table = 'tb_interesseTopico';
    protected $primaryKey = 'id_interesseTopico';
    protected $allowedFields = ['aprov_interesseTopico', 'id_topico', 'id_coop'];
    protected $returnType = 'object';
}
