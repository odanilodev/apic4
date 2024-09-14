<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateprodutoCategoria extends Migration
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
                'null' => true,
            ],
            'id_categoria' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'id_produto' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('produto_categoria');
	}

	public function down()
	{
		$this->forge->dropTable('produto_categoria');

	}
}
