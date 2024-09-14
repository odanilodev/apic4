<?php

namespace App\Repositories;

use App\Models\CategoriasModel;

class CategoriaRepository
{
    protected $CategoriasModel;

    public function __construct()
    {
        $this->CategoriasModel = new CategoriasModel();
    }

    public function findCategorias(int $idEmpresa)
    {
        return $this->CategoriasModel->where('id_empresa', $idEmpresa)->findAll();
    }

}
