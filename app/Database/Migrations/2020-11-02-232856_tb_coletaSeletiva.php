<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbColetaSeletiva extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id_coletaSeletiva' 		=> [
				'type'           			=> 'INT',
				'auto_increment' 			=> true,
			],
			'estado_coletaSeletiva' => [
				'type'           			=> 'CHAR',
				'constraint'          => '2',
			],
			'cidade_coletaSeletiva' => [
				'type'           			=> 'CHAR',
				'constraint'          => '75',
			],
			'bairro_coletaSeletiva'	=> [
				'type'           			=> 'CHAR',
				'constraint'          => '100',
			],
			'diasSemana_coletaSeletiva'	=> [
				'type'           			=> 'CHAR',
				'constraint'          => '20',
			],
		]);

		$this->forge->addPrimaryKey('id_coletaSeletiva');

		$this->forge->createTable('tb_coletaSeletiva');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_coletaSeletiva');
	}
}
