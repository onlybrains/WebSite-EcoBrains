<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbInteresseTopico extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id_interesseTopico' 		=> [
				'type'           			=> 'INT',
				'auto_increment' 			=> true,
			],
			'aprov_interesseTopico' => [
				'type'           			=> 'CHAR',
				'constraint'          => '1',
			],
			'id_topico'        			=> [
				'type'           			=> 'INT',
			],
			'id_coop'        				=> [
				'type'           			=> 'INT',
				'unsigned'            => true,
			],
		]);
		$this->forge->addPrimaryKey('id_interesseTopico');

		$this->forge->addForeignKey('id_topico', 'tb_topico', 'id_topico', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_coop', 'tb_cooperativas', 'id_coop');

		$this->forge->createTable('tb_interesseTopico');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_interesseTopico');
	}
}
