<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateprodutoModelo extends Migration
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
            'id_modelo' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_produto' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('produto_modelo');
	}

	public function down()
	{
		$this->forge->dropTable('produto_modelo');

	}
}
