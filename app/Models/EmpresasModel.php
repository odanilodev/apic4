<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresasModel extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['empresa', 'usuario', 'senha', 'responsavel', 'logo', 'telefone', 'plano', 'status', 'criado', 'editado'];  // camada de protecao contra sql inject

    // Regras de validação
    protected $validationRules = [
        'empresa'      => 'required|min_length[2]|max_length[150]',
        'usuario'      => 'required|min_length[2]|max_length[150]',
        'senha'        => 'required|min_length[8]|max_length[150]', 
        'responsavel'  => 'required|min_length[2]|max_length[150]',
        'logo'         => 'required|min_length[2]|max_length[150]',
        'telefone'     => 'required|min_length[10]|max_length[150]', 
        'plano'        => 'required|integer',
        'status'       => 'required|integer',
        'criado'       => 'required|valid_date',
        'editado'      => 'required|valid_date',
    ];

    // Mensagens de erro personalizadas
    protected $validationMessages = [
        'empresa' => [
            'required'   => 'O campo Empresa é obrigatório.',
            'min_length' => 'O campo Empresa deve ter pelo menos 2 caracteres.',
            'max_length' => 'O campo Empresa pode ter no máximo 150 caracteres.',
        ],
        'usuario' => [
            'required'   => 'O campo Usuário é obrigatório.',
            'min_length' => 'O campo Usuário deve ter pelo menos 2 caracteres.',
            'max_length' => 'O campo Usuário pode ter no máximo 150 caracteres.',
        ],
        'senha' => [
            'required'   => 'O campo Senha é obrigatório.',
            'min_length' => 'O campo Senha deve ter pelo menos 8 caracteres.',
            'max_length' => 'O campo Senha pode ter no máximo 150 caracteres.',
        ],
        'responsavel' => [
            'required'   => 'O campo Responsável é obrigatório.',
            'min_length' => 'O campo Responsável deve ter pelo menos 2 caracteres.',
            'max_length' => 'O campo Responsável pode ter no máximo 150 caracteres.',
        ],
        'logo' => [
            'required'   => 'O campo Logo é obrigatório.',
            'min_length' => 'O campo Logo deve ter pelo menos 2 caracteres.',
            'max_length' => 'O campo Logo pode ter no máximo 150 caracteres.',
        ],
        'telefone' => [
            'required'   => 'O campo Telefone é obrigatório.',
            'min_length' => 'O campo Telefone deve ter pelo menos 10 caracteres.',
            'max_length' => 'O campo Telefone pode ter no máximo 150 caracteres.',
        ],
        'plano' => [
            'required' => 'O campo Plano é obrigatório.',
            'integer'  => 'O campo Plano deve ser um número inteiro.',
        ],
        'status' => [
            'required' => 'O campo Status é obrigatório.',
            'integer'  => 'O campo Status deve ser um número inteiro.',
        ],
        'criado' => [
            'required'    => 'O campo Criado é obrigatório.',
            'valid_date' => 'O campo Criado deve ser uma data válida.',
        ],
        'editado' => [
            'required'    => 'O campo Editado é obrigatório.',
            'valid_date' => 'O campo Editado deve ser uma data válida.',
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
