<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\UserModel;



class UserController extends BaseController
{
  public function index()
  {
    $data = [];
    return view('login/index', $data);
  }

  public function signUp()
  {
    $session = \Config\Services::session();
    if ($session->get('id_login')) {
      return redirect()->to('sign-up/dados');
    }

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
          return redirect()->to('sign-up/dados');
        } else {
          $data['msg'] = 'Dados não cadastrados!';
        }
      }
    }


    return view('sign-up/index', $data);
  }

  public function dados()
  {
    $data = [];
    $isUnique = '';


    if ($this->request->getMethod() == 'post') {

      if ($this->request->getPost('inputTipo')) {

        $inputTipo = $this->request->getPost('inputTipo');

        if ($inputTipo == 'empresa') {
          $isUnique = 'tb_empresas.cnpj_empresa';
          $TipoModel = new EmpresaModel();
          $data['tipo_login'] = 'empresas';
        } else {
          $isUnique = 'tb_cooperativas.cnpj_coop';
          $TipoModel = new EmpresaModel();
          $data['tipo_login'] = 'cooperativas';
        }
      }

      $validationRules = [
        'inputTipo'        =>
        'required',

        'inputCNPJ'        =>
        'required|min_length[18]|is_unique[' . $isUnique . ']',

        'inputFantasia'    =>
        'required|alpha_numeric_space|min_length[5]|max_length[100]',

        'inputRazao'       =>
        'required|alpha_numeric_space|min_length[5]|max_length[100]',

        'inputCEP'         =>
        'required|min_length[9]',

        'inputNumEnd'      =>
        'required|alpha_numeric|greater_than[0]|max_length[5]',

        'inputComplemento' =>
        'alpha_numeric_space|max_length[10]',

        'inputEnd'         =>
        'min_length[13]',

        'inputTel'         =>
        'min_length[14]',

        'inputWhats'         =>
        'min_length[15]',
      ];

      $validationMessages = [
        'inputTipo'             => [
          'required'            => 'O campo tipo deve ser preenchido',
        ],
        'inputCNPJ'             => [
          'required'            => 'O campo CNPJ deve ser preenchido',
          'min_length'          => 'O campo CNPJ deve ser preenchido por completo',
          'is_unique'           => 'CNPJ já cadastrado',
        ],
        'inputFantasia'         => [
          'required'            => 'O campo nome fantasia deve ser preenchido',
          'alpha_numeric_space' => 'O campo nome fantasia deve ser preenchido por números e letras',
          'min_length'          => 'O campo nome fantasia deve ter no mínimo 5 caracteres',
          'max_length'          => 'O campo nome fantasia deve ter no máximo 100 caracteres',
        ],
        'inputRazao'            => [
          'required'            => 'O campo razão social deve ser preenchido',
          'alpha_numeric_space' => 'O campo razão social deve ser preenchido por números e letras',
          'min_length'          => 'O campo razão social deve ter no mínimo 5 caracteres',
          'max_length'          => 'O campo razão social deve ter no máximo 100 caracteres',
        ],
        'inputCEP'              => [
          'required'            => 'O campo CEP deve ser preenchido',
          'min_length'          => 'O campo CEP deve ter no mínimo 8',
        ],
        'inputNumEnd'           => [
          'required'            => 'O campo número deve ser preenchido',
          'alpha_numeric'       => 'O campo número deve ser preenchido por números',
          'greater_than'        => 'O campo número deve ser maior que 0',
          'max_length'          => 'O campo número deve ter no máximo 5 caracteres',
        ],
        'inputComplemento'      => [
          'alpha_numeric_space' => 'O campo número deve ser preenchido por números e letras',
          'max_length'          => 'O campo número deve ter no máximo 10 caracteres',
        ],
        'inputEnd'      => [
          'min_length'          => 'Digite um CEP valído',
        ],
        'inputTel'      => [
          'min_length'          => 'Telefone deve conter no mínimo 10 números',
        ],
        'inputWhats'      => [
          'min_length'          => 'Telefone deve conter no mínimo 11 números',
        ],
      ];


      if (!$this->validate($validationRules, $validationMessages)) {
        $data['validation'] = $this->validator;
      } else {
        $session = \Config\Services::session();


        $insertData = [
          'nomeFantasia_empresa' => $this->request->getPost('inputFantasia'),
          'razaoSoc_empresa' => $this->request->getPost('inputRazao'),
          'cnpj_empresa' => $this->request->getPost('inputCNPJ'),
          'cep_empresa' => $this->request->getPost('inputCEP'),
          'numEnd_empresa' => $this->request->getPost('inputNumEnd'),
          'tel_empresa' => $this->request->getPost('inputTel'),
          'whatsapp_empresa' => $this->request->getPost('inputWhats'),
          'id_login' => $session->get('id_login'),
        ];

        if ($TipoModel->insert($insertData)) {
          return redirect()->to($data['tipo_login'] . '/index');
        } else {
          $data['msg'] = 'Dados não cadastrados!';
        }
      }
    }

    return view('sign-up/step', $data);
  }
}
