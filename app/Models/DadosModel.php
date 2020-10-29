<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DescModel;
use App\Models\EmpresaModel;


class DadosModel extends Model
{
  protected $table      = 'tb_dados';
  protected $primaryKey = 'id_dados';

  protected $returnType     = 'object';

  protected $allowedFields = [
    'nomeFantasia_dados',
    'razaoSoc_dados',
    'cnpj_dados',
    'cep_dados',
    'numEnd_dados',
    'tel_dados',
    'whatsapp_dados',
    'complemento_dados',
  ];

  protected $beforeInsert = ['beforeInsert'];
  protected $afterInsert = ['afterInsert'];

  protected $validationRules = [
    'inputTipo'        =>
    'required',

    'cnpj_dados'        =>
    'required|min_length[14]|is_unique[tb_dados.cnpj_dados]',

    'nomeFantasia_dados'    =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'razaoSoc_dados'       =>
    'required|alpha_numeric_space|min_length[5]|max_length[100]',

    'cep_dados'         =>
    'required|min_length[8]',

    'numEnd_dados'      =>
    'required|alpha_numeric|greater_than[0]|max_length[5]',

    'complemento_dados' =>
    'alpha_numeric_space|max_length[10]',

    'inputEnd'         =>
    'min_length[13]',

    'tel_dados'         =>
    'min_length[10]',

    'whatsapp_dados'         =>
    'min_length[11]',
  ];

  // protected $validationMessages = [
  //   'inputTipo'             => [
  //     'required'            => 'O campo tipo deve ser preenchido',
  //   ],
  //   'cnpj_empresa'             => [
  //     'required'            => 'O campo CNPJ deve ser preenchido',
  //     'min_length'          => 'O campo CNPJ deve ser preenchido por completo',
  //     'is_unique'           => 'CNPJ já cadastrado',
  //   ],
  //   'nomeFantasia_empresa'         => [
  //     'required'            => 'O campo nome fantasia deve ser preenchido',
  //     'alpha_numeric_space' => 'O campo nome fantasia deve ser preenchido por números e letras',
  //     'min_length'          => 'O campo nome fantasia deve ter no mínimo 5 caracteres',
  //     'max_length'          => 'O campo nome fantasia deve ter no máximo 100 caracteres',
  //   ],
  //   'razaoSoc_empresa'            => [
  //     'required'            => 'O campo razão social deve ser preenchido',
  //     'alpha_numeric_space' => 'O campo razão social deve ser preenchido por números e letras',
  //     'min_length'          => 'O campo razão social deve ter no mínimo 5 caracteres',
  //     'max_length'          => 'O campo razão social deve ter no máximo 100 caracteres',
  //   ],
  //   'cep_empresa'              => [
  //     'required'            => 'O campo CEP deve ser preenchido',
  //     'min_length'          => 'O campo CEP deve ter no mínimo 8',
  //   ],
  //   'numEnd_empresa'           => [
  //     'required'            => 'O campo número deve ser preenchido',
  //     'alpha_numeric'       => 'O campo número deve ser preenchido por números',
  //     'greater_than'        => 'O campo número deve ser maior que 0',
  //     'max_length'          => 'O campo número deve ter no máximo 5 caracteres',
  //   ],
  //   'complemento_empresa'      => [
  //     'alpha_numeric_space' => 'O campo número deve ser preenchido por números e letras',
  //     'max_length'          => 'O campo número deve ter no máximo 10 caracteres',
  //   ],
  //   'inputEnd'      => [
  //     'min_length'          => 'Digite um CEP valído',
  //   ],
  //   'tel_empresa'      => [
  //     'min_length'          => 'Telefone deve conter no mínimo 10 números',
  //   ],
  //   'whatsapp_empresa'      => [
  //     'min_length'          => 'Telefone deve conter no mínimo 11 números',
  //   ],
  // ];



  protected function beforeInsert(array $data)
  {
    $model = new DescModel();

    $id_desc = $model->insert(['info_desc' => null]);

    $data['data']['id_desc'] = strval($id_desc);

    return $data;
  }

  protected function afterInsert($id, array $data)
  {
    if ($data['data']['inputTipo'] == 'empresa') {
      $model = new EmpresaModel();
      $dataInsert = [
        'id_dados' => $id,
        'id_desc' => $data['id_desc'],
        'id_login' => session()->get('id_login')
      ];

      $model->insert($dataInsert);
    } else {
    }
  }
}
