<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
  public function index()
  {
    return 'UserController';
  }

  public function signUp()
  {
    $data = [];

    if ($this->request->getMethod() == 'post') {

      $validationRules = [
        'inputEmail'      =>
        'required|valid_email|is_unique[tb_login.email_login]|min_length[5]|max_length[45]',

        'inputUser'       =>
        'required|alpha_dash|is_unique[tb_login.usuario_login]|min_length[5]|max_length[45]',

        'inputPassword'   =>
        'required|min_length[5]|max_length[45]',

        'inputPassword2'  =>
        'matches[inputPassword]',
      ];

      $validationMessages = [
        'inputEmail'      => [
          'required'      => 'O campo email deve ser preenchido de 5 a 45 caracteres',
          'min_length'    => 'O campo email deve ser preenchido de 5 a 45 caracteres',
          'max_length'    => 'O campo email deve ser preenchido de 5 a 45 caracteres',
          'valid_email'   => 'O campo email deve ser preenchido de 5 a 45 caracteres',
          'is_unique'     => 'E-mail já cadastrado',
        ],
        'inputUser'       => [
          'required'      => 'O campo usuário deve ser preenchido de 5 a 45 caracteres',
          'min_length'    => 'O campo usuário deve ser preenchido de 5 a 45 caracteres',
          'max_length'    => 'O campo usuário deve ser preenchido de 5 a 45 caracteres',
          'alpha_dash'    => 'O campo usuário pode conter letras, números e caracteres(-, _)',
          'is_unique'     => 'Usuário já cadastrado',
        ],
        'inputPassword'   => [
          'required'      => 'O campo usuário deve ser preenchido de 5 a 45 caracteres',
          'min_length'    => 'O campo usuário deve ser preenchido de 5 a 45 caracteres',
          'max_length'    => 'O campo usuário deve ser preenchido de 5 a 45 caracteres',
        ],
        'inputPassword2'  => [
          'matches'       => 'As senhas devem ser iguais',
        ]
      ];


      if (!$this->validate($validationRules, $validationMessages)) {
        $data['validation'] = $this->validator;
      } else {
        $UserModel = new UserModel();

        $insertData = [
          'email_login' => $this->request->getPost('inputEmail'),
          'usuario_login' => $this->request->getPost('inputUser'),
          'senha_login' => $this->request->getPost('inputPassword'),
        ];

        if ($UserModel->insert($insertData)) {
          $data['msg'] = 'Dados cadastrado com sucesso!';
        } else {
          $data['msg'] = 'Dados não cadastrados!';
        }
      }
    }


    return view('sign-up/index', $data);
  }
}
