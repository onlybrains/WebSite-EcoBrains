<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DadosModel;

class UserController extends BaseController
{
  public function index()
  {
    $data = [];
    helper(['form', 'auth']);

    if ($this->request->getMethod() == 'post') {

      $validationRules = [
        'inputUser' => [
          'rules' =>      'required|alpha_dash|min_length[5]|max_length[45]',
          'errors' => [
            'required' => 'O campo usuário deve ser preenchido.',
            'alpha_dash' => 'O campo usuário pode conter apenas caracteres alfanuméricos, sublinhados e traços.',
            'min_length' => 'O campo usuário deve ter no mínimo 5 caracteres.',
            'max_length' => 'O campo usuário deve ter no máximo 45 caracteres.'
          ]
        ],

        'inputPassword'   => [
          'rules' => 'required|min_length[5]|max_length[45]|validateUser[inputUser,inputPassword]',
          'errors' => [
            'required' => 'O campo senha deve ser preenchido.',
            'min_length' => 'O campo senha deve ter no mínimo 5 caracteres.',
            'max_length' => 'O campo senha deve ter no máximo 45 caracteres.',
            'validateUser' => 'Usuário e senha não batem!',
          ],
        ],
      ];


      if (!$this->validate($validationRules)) {
        $data['errors'] = $this->validator;
      } else {
        $model = new UserModel();
        $user = $model->where('usuario_login', $this->request->getPost('inputUser'))->first();

        setUserSession($user);
        return redirect()->to('/login');
      }
    }

    return view('login/index', $data);
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to('/');
  }

  public function signUp()
  {
    $data = [];
    helper(['form']);

    if ($this->request->getMethod() == 'post') {

      $insertData = [
        'email_login' => $this->request->getPost('inputEmail'),
        'usuario_login' => $this->request->getPost('inputUser'),
        'senha_login' => $this->request->getPost('inputPassword'),
        'inputPassword2' => $this->request->getPost('inputPassword2'),
      ];

      $model = new UserModel();
      if ($model->insert($insertData)) {

        return redirect()->to('/sign-up/dados');
      } else {
        $data['errors'] = $model->errors();
      }
    }

    return view('sign-up/index', $data);
  }

  public function dados()
  {
    $data = [];
    helper(['form', 'validation']);


    if ($this->request->getMethod() == 'post') {
      $model = new DadosModel();
      session()->setFlashdata('inputTipo', $this->request->getPost('inputTipo'));
      $data = [
        'inputTipo' => $this->request->getPost('inputTipo'),
        'cnpj_dados' => onlyNumbers($this->request->getPost('inputCNPJ')),
        'nomeFantasia_dados' => $this->request->getPost('inputFantasia'),
        'razaoSoc_dados' => $this->request->getPost('inputRazao'),
        'cep_dados' => onlyNumbers($this->request->getPost('inputCEP')),
        'numEnd_dados' => $this->request->getPost('inputNumEnd'),
        'complemento_dados' => $this->request->getPost('inputComplemento'),
        'inputEnd' => $this->request->getPost('inputEnd'),
        'tel_dados' => onlyNumbers($this->request->getPost('inputTel')),
        'whatsapp_dados' => onlyNumbers($this->request->getPost('inputWhats')),
      ];


      if ($model->insert($data)) {
        return redirect()->to('/login');
      } else {
        $data['errors'] = $model->errors();
      }
    }

    return view('sign-up/step', $data);
  }
}
