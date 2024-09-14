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
            ],
            'preco' => [
                'type' => 'DOUBLE',
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
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
            ],
            'tabela_nutricional' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'criado' => [
                'type' => 'DATETIME',
            ],
            'editado' => [
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'ordem' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => '0',
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
