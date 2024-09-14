<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createcategorias extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'nome' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
			],
			'id_pai' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => true,
			],
			'arquivo' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => true,
			],
			'descricao' => [
				'type' => 'TEXT',
				'null' => true,
			],
			'status' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'id_empresa' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'ordem' => [
				'type' => 'INT',
				'constraint' => 11,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey('status');
		$this->forge->createTable('categorias');
	}

	public function down()
	{
		$this->forge->dropTable('categorias');
	}
}
