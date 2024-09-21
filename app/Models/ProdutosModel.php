<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutosModel extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_empresa', 'preco', 'titulo', 'descricao', 'link_video', 'arquivo', 'tabela_nutricional', 'criado', 'editado', 'ordem']; 

    // Regras de validação
    protected $validationRules = [
        'id_empresa' => 'required|integer',
        'preco' => 'required|decimal',  
        'titulo' => 'required|min_length[2]|max_length[200]',
        'descricao' => 'permit_empty|string',
        'link_video' => 'permit_empty|valid_url|max_length[200]',
        'arquivo' => 'required|min_length[2]|max_length[200]',
        'tabela_nutricional' => 'permit_empty|string',
        'criado' => 'required|valid_date',
        'editado' => 'required|valid_date',
        'ordem' => 'required|integer',
    ];

    // Mensagens de erro personalizadas
    protected $validationMessages = [
        'id_empresa' => [
            'required' => 'O campo Id_empresa é obrigatório.',
            'integer' => 'O campo Id_empresa deve ser um número inteiro.'
        ],
        'preco' => [
            'required' => 'O campo Preço é obrigatório.',
            'decimal' => 'O campo Preço deve ser um número decimal.'
        ],
        'titulo' => [
            'required' => 'O campo Título é obrigatório.',
            'min_length' => 'O campo Título deve ter pelo menos 2 caracteres.',
            'max_length' => 'O campo Título pode ter no máximo 200 caracteres.'
        ],
        'descricao' => [
            'string' => 'O campo Descrição deve ser uma string.'
        ],
        'link_video' => [
            'valid_url' => 'O campo Link de Vídeo deve ser uma URL válida.',
            'max_length' => 'O campo Link de Vídeo pode ter no máximo 200 caracteres.'
        ],
        'arquivo' => [
            'required' => 'O campo Arquivo é obrigatório.',
            'min_length' => 'O campo Arquivo deve ter pelo menos 2 caracteres.',
            'max_length' => 'O campo Arquivo pode ter no máximo 200 caracteres.'
        ],
        'tabela_nutricional' => [
            'string' => 'O campo Tabela Nutricional deve ser uma string.'
        ],
        'criado' => [
            'required' => 'O campo Criado é obrigatório.',
            'valid_date' => 'O campo Criado deve ser uma data válida.'
        ],
        'editado' => [
            'required' => 'O campo Editado é obrigatório.',
            'valid_date' => 'O campo Editado deve ser uma data válida.'
        ],
        'ordem' => [
            'required' => 'O campo Ordem é obrigatório.',
            'integer' => 'O campo Ordem deve ser um número inteiro.'
        ],
    ];

    public function validateData($data)
    {
        if (!$this->validate($data)) {
            return $this->errors();
        }
        return true;
    }
}
