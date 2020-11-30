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

  protected $validationMessages = [
    'email_login'      =>
    [
      'required' => 'O campo email deve ser preenchido.',
      'valid_email' => 'O campo email deve ser um email válido.',
      'is_unique' => 'O valor do campo email já existe.',
      'min_length' => 'O campo email deve ter no mínimo 5 caracteres.',
      'max_length' => 'O campo email deve ter no máximo 45 caracteres.'
    ],
    
    'usuario_login'       =>   [
      'required' => 'O campo usuário deve ser preenchido.',
      'alpha_dash' => 'O campo usuário pode conter apenas caracteres alfanuméricos, sublinhados e traços.',
      'is_unique' => 'O valor do campo usuário já existe.',
      'min_length' => 'O campo usuário deve ter no mínimo 5 caracteres.',
      'max_length' => 'O campo usuário deve ter no máximo 45 caracteres.'
    ],

    'senha_login'   =>
    [
      'required' => 'O campo senha deve ser preenchido.',
      'min_length' => 'O campo senha deve ter no mínimo 5 caracteres.',
      'max_length' => 'O campo senha deve ter no máximo 45 caracteres.'
    ],

    'inputPassword2'  =>  [
    'matches' => 'As senhas não são iguais.',
    ]
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

      helper('auth');
      setUserSession($user);
    }
  }
}
