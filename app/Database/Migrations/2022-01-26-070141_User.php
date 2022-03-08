<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_user'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 64
			],
			'username'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'password'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'privilage'      => [
				'type'           => 'ENUM',
				'constraint'     => ['user', 'admin'],
				'default'        => 'user',
			],
			'divisi'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id_user', TRUE);

		// Membuat tabel news
		$this->forge->createTable('user', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
