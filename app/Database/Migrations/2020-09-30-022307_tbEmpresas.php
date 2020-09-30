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
			'nomeFantasia_empresa' => [
				'type' 							 => 'VARCHAR',
				'constraint' 				 => '100',
			],
			'razaoSoc_empresa' 		 => [
				'type'						 	 => 'VARCHAR',
				'constraint'				 => '100',
			],
			'cnpj_empresa'				 => [
				'type' 							 => 'VARCHAR',
				'constraint'				 => '14',
			],
			'cep_empresa' 				 => [
				'type'							 => 'VARCHAR',
				'constraint'				 => '8',
			],
			'numEnd_empresa'			 => [
				'type'							 => 'VARCHAR',
				'constraint'				 => '5',
			],
			'tel_empresa'					 => [
				'type'							 => 'VARCHAR',
				'constraint'				 => '10',
			],
			'whatsapp_empresa'		 => [
				'type'							 => 'VARCHAR',
				'constraint'				 => '10',
			],
			'id_login'						 => [
				'type'							 => 'INT'
			],
			'id_desc'							 => [
				'type'							 => 'INT'
			],
		]);

		$this->forge->addPrimaryKey('id_empresa');

		$this->forge->addForeignKey('id_login', 'tb_login', 'id_login');
		$this->forge->addForeignKey('id_desc', 'tb_desc', 'id_desc');

		$this->forge->createTable('tb_empresas');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_empresas');
	}
}
