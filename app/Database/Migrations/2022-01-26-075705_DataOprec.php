<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataOprec extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'divisi'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 100
			],
			'nim'       => [
				'type'           => 'INT',
				'constraint'     => 11
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('data_oprec', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('data_oprec');
	}
}
