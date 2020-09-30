<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbTopico extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id_topico'         => [
				'type'            => 'INT',
				'auto_increment'  => true,
			],
			'titulo_topico'     => [
				'type'            => 'VARCHAR',
				'constraint' 		  => '45',
			],
			'dataLimite_topico' => [
				'type'            => 'DATETIME',
			],
			'id_empresa'        => [
				'type'            => 'INT',
				'unsigned' 			  => true,
			],
		]);
		$this->forge->addPrimaryKey('id_topico');

		$this->forge->addForeignKey('id_empresa', 'tb_empresas', 'id_empresa');

		$this->forge->createTable('tb_topico');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_topico');
	}
}
