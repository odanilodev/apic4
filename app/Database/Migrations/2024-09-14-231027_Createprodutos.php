<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createprodutos extends Migration
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
			'id_empresa' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
			'preco' => [
				'type' => 'DOUBLE',
				'null' => false,
			],
			'titulo' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => false,
			],
			'descricao' => [
				'type' => 'TEXT',
				'null' => true,
			],
			'link_video' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => true,
			],
			'arquivo' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => false,
			],
			'tabela_nutricional' => [
				'type' => 'TEXT',
				'null' => true,
			],
			'criado' => [
				'type' => 'DATETIME',
				'null' => false,
			],
			'editado' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'ordem' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => false,
				'default' => 0,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('produtos');
	}

	public function down()
	{
		$this->forge->dropTable('produtos');
	}
}
