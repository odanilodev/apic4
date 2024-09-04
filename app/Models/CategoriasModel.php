<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'id_pai', 'arquivo', 'descricao', 'status', 'id_empresa', 'ordem'];  // camada de protecao contra sql inject

    // Regras de validação
    protected $validationRules = [
        'nome' => 'required|min_length[2]|max_length[200]',
        'id_pai' => 'permit_empty|integer',
        'arquivo' => 'permit_empty|min_length[2]|max_length[200]',
        'status' => 'required|integer',
        'id_empresa' => 'required|integer',
        'ordem' => 'required|integer',
    ];

    // Mensagens de erro personalizadas
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O campo Nome deve ter pelo menos 2 caracteres.',
            'max_length' => 'O campo Nome pode ter no máximo 200 caracteres.'
        ],
        'id_pai' => [
            'integer' => 'O campo Id_pai deve ser um número inteiro.'
        ],
        'arquivo' => [
            'min_length' => 'O campo Arquivo deve ter pelo menos 2 caracteres.',
            'max_length' => 'O campo Arquivo pode ter no máximo 200 caracteres.'
        ],
        'status' => [
            'required' => 'O campo Status é obrigatório.',
            'integer' => 'O campo Quantidade deve ser um número inteiro.'
        ],
        'id_empresa' => [
            'required' => 'O campo Id_empresa é obrigatório.',
            'integer' => 'O campo Quantidade deve ser um número inteiro.'
        ],
        'ordem' => [
            'required' => 'O campo Ordem é obrigatório.',
            'integer' => 'O campo Quantidade deve ser um número inteiro.'
        ]
    ];

    public function validateData($data)
    {
        if (!$this->validate($data)) {
            return $this->errors();
        }
        return true;
    }
}
