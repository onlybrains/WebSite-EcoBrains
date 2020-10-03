<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnLogin extends Migration
{
	public function up()
	{
		$field = [
			'tipo_login' 		=> [
				'type'           			=> 'CHAR',
				'constraint' 			=> '1',
			],
		];


		$this->forge->addColumn('tb_login', $field);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropColumn('tb_login', 'tipo_login');
	}
}
