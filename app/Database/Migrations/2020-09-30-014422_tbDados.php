<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbDados extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'id_dados' 					 => [
				'type' 							 => 'INT',
				'unsigned'					 => true,
				'auto_increment'		 => true,
			],
			'nomeFantasia_dados' => [
				'type' 							 => 'VARCHAR',
				'constraint' 				 => '100',
			],
			'razaoSoc_dados' 		 => [
				'type'						 	 => 'VARCHAR',
				'constraint'				 => '100',
			],
			'cnpj_dados'				 => [
				'type' 							 => 'VARCHAR',
				'constraint'				 => '14',
			],
			'cep_dados' 				 => [
				'type'							 => 'VARCHAR',
				'constraint'				 => '8',
			],
			'numEnd_dados'			 => [
				'type'							 => 'VARCHAR',
				'constraint'				 => '5',
			],
			'tel_dados'					 => [
				'type'							 => 'VARCHAR',
				'constraint'				 => '10',
			],
			'whatsapp_dados'		 => [
				'type'							 => 'VARCHAR',
				'constraint'				 => '11',
			],
			'complemento_dados' 		=> [
				'type'           			=> 'VARCHAR',
				'constraint' 					=> '10',
			],
		]);

		$this->forge->addPrimaryKey('id_dados');

		$this->forge->createTable('tb_dados');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_dados');
	}
}
