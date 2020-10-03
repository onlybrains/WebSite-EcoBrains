<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnEmpresas extends Migration
{
	public function up()
	{
		$field = [
			'complemento_empresa' 		=> [
				'type'           			=> 'VARCHAR',
				'constraint' 			=> '10',
			],
		];


		$this->forge->addColumn('tb_empresas', $field);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropColumn('tb_empresas', 'complemento_empresa');
	}
}
