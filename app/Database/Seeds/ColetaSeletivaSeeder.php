<?php
namespace App\Database\Seeds;

class ColetaSeletivaSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $data = [
      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Bela Vista',
        'diasSemana_coletaSeletiva' => 'Segunda-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Inocoop',
        'diasSemana_coletaSeletiva' => 'Segunda-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Jd. Santa Francisca',
        'diasSemana_coletaSeletiva' => 'Segunda-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Vila Carmela',
        'diasSemana_coletaSeletiva' => 'Segunda-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Vila Barros I e II',
        'diasSemana_coletaSeletiva' => 'Terça-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'JD. Flamengo',
        'diasSemana_coletaSeletiva' => 'Terça-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Jd. Ipanema',
        'diasSemana_coletaSeletiva' => 'Quarta-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Bom Clima I, II e III',
        'diasSemana_coletaSeletiva' => 'Quarta-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Presidente Dutra',
        'diasSemana_coletaSeletiva' => 'Quarta-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Vila Fátima I e II',
        'diasSemana_coletaSeletiva' => 'Quinta-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Jd. Palmira',
        'diasSemana_coletaSeletiva' => 'Quinta-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Haroldo Veloso',
        'diasSemana_coletaSeletiva' => 'Sexta-feira'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Monte Carmelo',
        'diasSemana_coletaSeletiva' => 'Sábado'
      ],

      [
        'estado_coletaSeletiva' => 'SP',
        'cidade_coletaSeletiva' => 'Guarulhos',
        'bairro_coletaSeletiva' => 'Continental I e II',
        'diasSemana_coletaSeletiva' => 'Sábado'
      ],
      
    ];

    // Using Query Builder
    $this->db->table('tb_coletaSeletiva')->insertBatch($data);
  }
}

?>