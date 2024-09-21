<?php

namespace App\Services;

use App\Repositories\ProdutoRepository;

class ProdutoService
{
    protected $ProdutosRepository;

    public function __construct()
    {
        $this->ProdutosRepository = new ProdutoRepository();
    }

    public function getProdutos(int $idEmpresa)
    {
        return $this->ProdutosRepository->findProdutosCategorias($idEmpresa);
    }

    public function getProdutoId(int $idProduto, int $idEmpresa)
    {
        return $this->ProdutosRepository->findProdutoId($idProduto, $idEmpresa);
    }

   
}
