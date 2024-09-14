<?php

namespace App\Services;

use App\Repositories\CategoriaRepository;

class CategoriaService
{
    protected $CategoriasRepository;

    public function __construct()
    {
        $this->CategoriasRepository = new CategoriaRepository();
    }

    public function getCategorias(int $idEmpresa)
    {
        return $this->CategoriasRepository->findCategorias($idEmpresa);
    }

   
}
