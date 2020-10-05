<?php

namespace App\Controllers;

use App\Models\CoopModel;
use App\Models\UserModel;
use App\Models\EmpresaModel;



class UserController extends BaseController
{
  public function index()
  {
    $data = [];
    helper(['form']);

    if (session()->get('isLoggedIn')) {

      $modelEmpresa = new EmpresaModel();
      $coopModel = new CoopModel();

      if ($modelEmpresa->where('id_login', session()->get('id_login'))->first())
        return redirect()->to('empresas');

      elseif ($coopModel->where('id_login', session()->get('id_login'))->first())
        return redirect()->to('cooperativas');

      return redirect()->to('sign-up/dados');
    }


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
        $user = $model->where('usuario_login', $this->request->getPost('inputUser'))->first();
        session()->set($model->setUserSession($user));
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
    helper(['form']);


    if ($this->request->getMethod() == 'post') {

      if ($this->request->getPost('inputTipo')) {

        $inputTipo = $this->request->getPost('inputTipo');

        if ($inputTipo == 'empresa') {
          $model = new EmpresaModel();
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
        } else {
          $model = new CoopModel();
          $insertData = [
            'inputTipo' => $this->request->getPost('inputTipo'),
            'cnpj_coop' => onlyNumbers($this->request->getPost('inputCNPJ')),
            'nomeFantasia_coop' => $this->request->getPost('inputFantasia'),
            'razaoSoc_coop' => $this->request->getPost('inputRazao'),
            'cep_coop' => onlyNumbers($this->request->getPost('inputCEP')),
            'numEnd_coop' => $this->request->getPost('inputNumEnd'),
            'complemento_coop' => $this->request->getPost('inputComplemento'),
            'inputEnd' => $this->request->getPost('inputEnd'),
            'tel_coop' => onlyNumbers($this->request->getPost('inputTel')),
            'whatsapp_coop' => onlyNumbers($this->request->getPost('inputWhats')),
          ];
        }
      } else {
        $data['errors'] = ['error' => 'Insira o tipo de cadastro'];
        return view('sign-up/step', $data);
      }




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
