<?php

namespace App\Database\Seeds;

class TpResiduosSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $data = [
      'nome_tpResiduo' => 'Metal',
    ];


    // Using Query Builder
    $tpResiduosModel = new \App\Models\TipoResiduoModel();

    $tpResiduosModel
      ->table('tb_tpresiduos')
      ->insert($data);
  }
}
