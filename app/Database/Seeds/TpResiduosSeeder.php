<?php

namespace App\Database\Seeds;

class TpResiduosSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $data = [
      [
        'nome_tpResiduo' => 'Papel/Papelão',
      ],

      [
        'nome_tpResiduo' => 'Plástico',
      ],

      [
        'nome_tpResiduo' => 'Vidro',
      ],

      [
        'nome_tpResiduo' => 'Metal',
      ],

      [
        'nome_tpResiduo' => 'Madeira',
      ],

      [
        'nome_tpResiduo' => 'Resíduos Perigosos',
      ],

      [
        'nome_tpResiduo' => 'Hospitalar',
      ],

      [
        'nome_tpResiduo' => 'Radioativos',
      ],

      [
        'nome_tpResiduo' => 'Orgânicos',
      ],
      
    ];

    // Using Query Builder
    $this->db->table('tb_tpresiduos')->insertBatch($data);
  }
}
