<?php

namespace App\Database\Seeds;

class TpResiduosSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $data = [
      [
        'nome_tpResiduo' => 'Metal',
      ],

      [
        'nome_tpResiduo' => 'Pihas e Baterias',
      ],

      [
        'nome_tpResiduo' => 'Papel',
      ],

      [
        'nome_tpResiduo' => 'Madeira',
      ],
      
      [
        'nome_tpResiduo' => 'Lixo Hospitalar',
      ],
    ];

    // Using Query Builder
    $this->db->table('tb_tpresiduos')->insertBatch($data);
  }
}
