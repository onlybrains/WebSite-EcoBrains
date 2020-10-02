<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbResiduos extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id_residuo'			 => [
				'type'					 => 'INT',
				'auto_increment' => true,
			],
			'quant_residuo'		 => [
				'type'					 => 'FLOAT',
			],
			'id_tpResiduo'     => [
				'type'       		 => 'INT',
			],
			'id_desc'	         => [
				'type'           => 'INT',
			],
		]);
		$this->forge->addPrimaryKey('id_residuo');

		$this->forge->addForeignKey('id_tpResiduo', 'tb_tpResiduos', 'id_tpResiduo');
		$this->forge->addForeignKey('id_desc', 'tb_desc', 'id_desc');

		$this->forge->createTable('tb_residuos');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_residuos');
	}
}
