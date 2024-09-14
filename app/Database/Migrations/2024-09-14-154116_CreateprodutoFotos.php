<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateprodutoFotos extends Migration
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
            'id_produto' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'arquivo' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'principal' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('produto_fotos');

	}

	public function down()
	{
		$this->forge->dropTable('produto_fotos');

	}
}
