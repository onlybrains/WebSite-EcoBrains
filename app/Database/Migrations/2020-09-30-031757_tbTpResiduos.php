<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbTpResiduos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tpResiduo'          => [
				'type'           			=> 'INT',
				'auto_increment' 			=> true,
			],
			'nome_tpResiduo'        => [
				'type'           			=> 'VARCHAR',
				'constraint'     			=> '45',
			],
		]);
		$this->forge->addPrimaryKey('id_tpResiduo');

		$this->forge->createTable('tb_tpResiduos');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_tpResiduos');
	}
}
