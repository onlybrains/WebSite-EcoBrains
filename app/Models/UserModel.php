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
  protected $afterInsert = ['afterInsert'];

  protected $validationRules = [
    'email_login'      =>
    'required|valid_email|is_unique[tb_login.email_login]|min_length[5]|max_length[45]',

    'usuario_login'       =>
    'required|alpha_dash|is_unique[tb_login.usuario_login]|min_length[5]|max_length[45]',

    'senha_login'   =>
    'required|min_length[5]|max_length[45]',

    'inputPassword2'  =>
    'matches[senha_login]',
  ];

  protected function hashPassword(array $data)
  {
    if (isset($data['data']['senha_login']))
      $data['data']['senha_login'] = password_hash($data['data']['senha_login'], PASSWORD_DEFAULT);


    return $data;
  }

  protected function afterInsert(array $data)
  {
    if ($data['id']) {

      $user = (object)[
        'id_login' => $data['id'],
        'email_login' => $data['data']['email_login'],
        'usuario_login' => $data['data']['usuario_login'],
      ];

      session()->set($this->setUserSession($user));
    }
  }

  public function setUserSession(object $user)
  {
    return [
      'id_login' => $user->id_login,
      'email_login' => $user->email_login,
      'usuario_login' => $user->usuario_login,
      'isLoggedIn' => true,
    ];
  }
}
