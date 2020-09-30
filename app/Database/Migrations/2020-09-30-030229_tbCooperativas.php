<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbCooperativas extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id_coop' 					=> [
				'type'						=> 'INT',
				'unsigned'				=> true,
				'auto_increment'  => true,
			],
			'nomeFantasia_coop' => [
				'type' 						=> 'VARCHAR',
				'constraint' 			=> '100',
			],
			'razaoSoc_coop' 		=> [
				'type' 						=> 'VARCHAR',
				'constraint' 			=> '100',
			],
			'cnpj_coop' 				=> [
				'type' 						=> 'VARCHAR',
				'constraint' 			=> '14',
			],
			'cep_coop' 					=> [
				'type' 						=> 'VARCHAR',
				'constraint' 			=> '8',
			],
			'numEnd_coop' 			=> [
				'type' 						=> 'VARCHAR',
				'constraint' 			=> '5',
			],
			'tel_coop' 					=> [
				'type' 						=> 'VARCHAR',
				'constraint' 			=> '10',
			],
			'whatsapp_coop' 		=> [
				'type' 						=> 'VARCHAR',
				'constraint' 			=> '10',
			],
			'id_login' 					=> [
				'type' 						=> 'INT'
			],
			'id_desc' 					=> [
				'type' 						=> 'INT'
			],
		]);

		$this->forge->addPrimaryKey('id_coop');

		$this->forge->addForeignKey('id_login', 'tb_login', 'id_login');
		$this->forge->addForeignKey('id_desc', 'tb_desc', 'id_desc');

		$this->forge->createTable('tb_cooperativas');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_cooperativas');
	}
}
