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
      ->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
      ->join('tb_desc', 'tb_desc.id_desc = tb_empresas.id_desc')
      ->where('id_login', session()->get('id_login'))->first();
  } elseif (isEmpresaOrCoop() == 'coop') {
    $model = new CoopModel();
    return $model
      ->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
      ->join('tb_desc', 'tb_desc.id_desc = tb_cooperativas.id_desc')
      ->where('id_login', session()->get('id_login'))->first();
  }
}
