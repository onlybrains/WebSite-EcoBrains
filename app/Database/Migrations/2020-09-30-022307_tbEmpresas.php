<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbEmpresas extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id_empresa' 					 => [
				'type' 							 => 'INT',
				'unsigned'					 => true,
				'auto_increment'		 => true,
			],
			'id_login'						 => [
				'type'							 => 'INT'
			],
			'id_desc'							 => [
				'type'							 => 'INT'
			],
			'id_dados' 					=> [
				'type' 						=> 'INT',
				'unsigned'					 => true,
			],
		]);

		$this->forge->addPrimaryKey('id_empresa');

		$this->forge->addForeignKey('id_login', 'tb_login', 'id_login');
		$this->forge->addForeignKey('id_desc', 'tb_desc', 'id_desc');

		$this->forge->addForeignKey('id_dados', 'tb_dados', 'id_dados');

		$this->forge->createTable('tb_empresas');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_empresas');
	}
}
