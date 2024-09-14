<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmpresaSeeder extends Seeder
{
	public function run()
	{
		$data = [
            [
                'id' => 1,
                'empresa' => 'Empresa 1',
                'usuario' => 'empresa_1',
                'senha' => '$2y$10$2yzF6eD/Ifpjl0hj.x49hujrQgaXjXst98aX254yZXuRV81iEqO2C',
                'responsavel' => 'Danilo',
                'logo' => 'teste.jpg',
                'telefone' => '14996010303',
                'plano' => 3,
                'status' => 1,
                'criado' => '2024-08-01 09:27:17',
                'editado' => '2024-08-01 09:27:17',
            ],
            [
                'id' => 2,
                'empresa' => 'Empresa teste',
                'usuario' => 'teste_1',
                'senha' => '$2y$10$2yzF6eD/Ifpjl0hj.x49hujrQgaXjXst98aX254yZXuRV81iEqO2C',
                'responsavel' => 'Lipe',
                'logo' => 'teste2.jpg',
                'telefone' => '14997670560',
                'plano' => 2,
                'status' => 1,
                'criado' => '2024-08-01 09:28:44',
                'editado' => '2024-08-01 09:28:44',
            ],
        ];

        $this->db->table('empresa')->insertBatch($data);
	}
}
