<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbResiduosTopico extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id_residuo'       => [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'quant_residuo'    => [
				'type'           => 'FLOAT',
			],
			'id_tpResiduo'     => [
				'type'           => 'INT',
			],
			'id_topico'        => [
				'type'           => 'INT',
			],
		]);
		$this->forge->addPrimaryKey('id_residuo');

		$this->forge->addForeignKey('id_tpResiduo', 'tb_tpResiduos', 'id_tpResiduo');
		$this->forge->addForeignKey('id_topico', 'tb_topico', 'id_topico');

		$this->forge->createTable('tb_residuosTopico');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_residuosTopico');
	}
}
