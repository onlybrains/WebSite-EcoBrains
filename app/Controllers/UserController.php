<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\EmpresaModel;



class UserController extends BaseController
{
  public function index()
  {
    $data = [];
    helper(['form']);

    if (session()->get('isLoggedIn'))
      return redirect()->to('sign-up/dados');

    if ($this->request->getMethod() == 'post') {

      $validationRules = [
        'inputUser' =>
        'required|alpha_dash|min_length[5]|max_length[45]',

        'inputPassword'   => [
          'rules' => 'required|min_length[5]|max_length[45]|validateUser[inputUser,inputPassword]',
          'errors' => [
            'validateUser' => 'Usuário e senha não batem!',
          ],
        ],
      ];


      if (!$this->validate($validationRules)) {
        $data['errors'] = $this->validator;
      } else {
        $model = new UserModel();

        $user = $model
          ->where('usuario_login', $this->request->getPost('inputUser'))
          ->first();


        session()->set($model->setUserSession($user));
        switch ($user->tipo_login) {
          case '1':
            //ir pra rota de empresas
            break;

          case '2':
            //ir pra rota de coops
            break;

          default:
            return redirect()->to('sign-up/dados');
            break;
        }
      }
    }

    return view('login/index', $data);
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
    helper(['form']);


    if ($this->request->getMethod() == 'post') {

      if ($this->request->getPost('inputTipo')) {

        $inputTipo = $this->request->getPost('inputTipo');

        if ($inputTipo == 'empresa') {
          $model = new EmpresaModel();
        } else {
          $model = new EmpresaModel();
        }
      }

      $insertData = [
        'inputTipo' => $this->request->getPost('inputTipo'),
        'cnpj_empresa' => onlyNumbers($this->request->getPost('inputCNPJ')),
        'nomeFantasia_empresa' => $this->request->getPost('inputFantasia'),
        'razaoSoc_empresa' => $this->request->getPost('inputRazao'),
        'cep_empresa' => onlyNumbers($this->request->getPost('inputCEP')),
        'numEnd_empresa' => $this->request->getPost('inputNumEnd'),
        'complemento_empresa' => $this->request->getPost('inputComplemento'),
        'inputEnd' => $this->request->getPost('inputEnd'),
        'tel_empresa' => onlyNumbers($this->request->getPost('inputTel')),
        'whatsapp_empresa' => onlyNumbers($this->request->getPost('inputWhats')),
      ];

      if ($model->insert($insertData)) {
        return redirect()->to('/login');
      } else {
        $data['errors'] = $model->errors();
      }
    }

    return view('sign-up/step', $data);
  }
}

function onlyNumbers(string $value)
{
  return $value = preg_replace("/[^0-9]/", "", $value);
}
