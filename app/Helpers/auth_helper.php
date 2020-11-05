<?php

use App\Models\CoopModel;
use App\Models\EmpresaModel;

function setUserSession(object $user)
{
  session()->set([
    'id_login' => $user->id_login,
    'email_login' => $user->email_login,
    'usuario_login' => $user->usuario_login,
    'isLoggedIn' => true,
  ]);
}

function isEmpresaOrCoop()
{
  if (session()->get('isLoggedIn')) {

    $modelEmpresa = new EmpresaModel();
    $coopModel = new CoopModel();

    if ($modelEmpresa->where('id_login', session()->get('id_login'))->first())
      return 'empresa';

    elseif ($coopModel->where('id_login', session()->get('id_login'))->first())
      return 'coop';

    return 'dados';
  }
}

function getBasicUserInfo()
{
  if (isEmpresaOrCoop() == 'empresa') {
    $model = new EmpresaModel();
    return $model
      ->select('id_empresa, nomeFantasia_dados, razaoSoc_dados, cep_dados')
      ->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
      ->where('id_login', session()->get('id_login'))->first();
  } elseif (isEmpresaOrCoop() == 'coop') {
    $model = new CoopModel();
    return $model
      ->select('id_coop, nomeFantasia_dados, razaoSoc_dados, cep_dados')
      ->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
      ->where('id_login', session()->get('id_login'))->first();
  }
}
