<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createempresa extends Migration
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
            'empresa' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'usuario' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'senha' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'responsavel' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'plano' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'criado' => [
                'type' => 'DATETIME',
            ],
            'editado' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('usuario');
        $this->forge->addKey('status');
        $this->forge->createTable('empresa');
    }

    public function down()
    {
        $this->forge->dropTable('empresa');
    }
}
