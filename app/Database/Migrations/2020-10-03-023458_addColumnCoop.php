<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnCoop extends Migration
{
	public function up()
	{
		$field = [
			'complemento_coop' 		=> [
				'type'           			=> 'VARCHAR',
				'constraint' 			=> '10',
			],
		];


		$this->forge->addColumn('tb_cooperativas', $field);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropColumn('tb_cooperativas', 'complemento_coop');
	}
}
