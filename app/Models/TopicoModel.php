<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DescModel;


class TopicoModel extends Model
{
  protected $table      = 'tb_topico';
  protected $primaryKey = 'id_topico';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'titulo_topico',
    'dataLimite_topico',
    'id_empresa',
  ];

  protected $beforeInsert = ['beforeInsert'];
  // protected $beforeUpdate = ['hashPassword'];

  protected $validationRules = [
    'inputTipo'        =>
    'required',

    'titulo_topico'    =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'dataLimite_topico'         =>
    'required|min_length[8]|max_length[10]',

    'id_empresa'         =>
    'min_length[1]|max_lenght[1]',
  ];

  // protected $validationMessages = [
  //   'inputTipo'             => [
  //     'required'            => 'O campo tipo deve ser preenchido',
  //   ],
  //   'cnpj_coop'             => [
  //     'required'            => 'O campo CNPJ deve ser preenchido',
  //     'min_length'          => 'O campo CNPJ deve ser preenchido por completo',
  //     'is_unique'           => 'CNPJ já cadastrado',
  //   ],
  //   'nomeFantasia_coop'         => [
  //     'required'            => 'O campo nome fantasia deve ser preenchido',
  //     'alpha_numeric_space' => 'O campo nome fantasia deve ser preenchido por números e letras',
  //     'min_length'          => 'O campo nome fantasia deve ter no mínimo 5 caracteres',
  //     'max_length'          => 'O campo nome fantasia deve ter no máximo 100 caracteres',
  //   ],
  //   'razaoSoc_coop'            => [
  //     'required'            => 'O campo razão social deve ser preenchido',
  //     'alpha_numeric_space' => 'O campo razão social deve ser preenchido por números e letras',
  //     'min_length'          => 'O campo razão social deve ter no mínimo 5 caracteres',
  //     'max_length'          => 'O campo razão social deve ter no máximo 100 caracteres',
  //   ],
  //   'cep_coop'              => [
  //     'required'            => 'O campo CEP deve ser preenchido',
  //     'min_length'          => 'O campo CEP deve ter no mínimo 8',
  //   ],
  //   'numEnd_coop'           => [
  //     'required'            => 'O campo número deve ser preenchido',
  //     'alpha_numeric'       => 'O campo número deve ser preenchido por números',
  //     'greater_than'        => 'O campo número deve ser maior que 0',
  //     'max_length'          => 'O campo número deve ter no máximo 5 caracteres',
  //   ],
  //   'complemento_coop'      => [
  //     'alpha_numeric_space' => 'O campo número deve ser preenchido por números e letras',
  //     'max_length'          => 'O campo número deve ter no máximo 10 caracteres',
  //   ],
  //   'inputEnd'      => [
  //     'min_length'          => 'Digite um CEP valído',
  //   ],
  //   'tel_coop'      => [
  //     'min_length'          => 'Telefone deve conter no mínimo 10 números',
  //   ],
  //   'whatsapp_coop'      => [
  //     'min_length'          => 'Telefone deve conter no mínimo 11 números',
  //   ],
  // ];
}
