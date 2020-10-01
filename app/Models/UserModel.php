<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table      = 'tb_login';
  protected $primaryKey = 'id_login';

  protected $returnType     = 'object';

  protected $allowedFields = ['email_login', 'usuario_login', 'senha_login'];

  protected $beforeInsert = ['hashPassword'];
  protected $beforeUpdate = ['hashPassword'];


  protected function hashPassword(array $data)
  {
    if (isset($data['data']['senha_login']))
      $data['data']['senha_login'] = password_hash($data['data']['senha_login'], PASSWORD_DEFAULT);


    return $data;
  }
}
