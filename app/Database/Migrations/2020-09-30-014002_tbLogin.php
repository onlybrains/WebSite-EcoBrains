<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbLogin extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_login'         => [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'email_login'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '45',
			],
			'usuario_login'    => [
				'type'           => 'VARCHAR',
				'constraint'     => '45',
			],
			'senha_login' 		 => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
		]);

		$this->forge->addPrimaryKey('id_login');

		$this->forge->addUniqueKey(['email_login', 'uni']);

		$this->forge->createTable('tb_login');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_login');
	}
}
