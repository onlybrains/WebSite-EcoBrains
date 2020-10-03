<?php

namespace App\Validation;

use App\Models\UserModel;

class UserRules
{
  public function validateUser(string $str, string $fields, array $data)
  {
    $model = new UserModel();
    $user = $model
      ->where('usuario_login', $data['inputUser'])
      ->first();

    if (!$user) return false;

    return password_verify($data['inputPassword'], $user->senha_login);
  }
}
