<?php

namespace App\Repositories;

use App\Models\ProdutosModel;

class ProdutoRepository
{
    protected $ProdutosModel;

    public function __construct()
    {
        $this->ProdutosModel = new ProdutosModel();
    }

    public function findProdutosCategorias(int $idEmpresa)
    {
        return $this->ProdutosModel
        ->select('produtos.id, produtos.titulo, produtos.preco, produtos.arquivo, produtos.descricao, C.nome AS CATEGORIA')
        ->join('produto_categoria PC', 'PC.id_produto = produtos.id', 'left')
        ->join('categorias C', 'C.id = PC.id_categoria', 'left')
        ->where('produtos.id_empresa', $idEmpresa)
        ->where('PC.id_empresa', $idEmpresa)
        ->findAll();
    }

    public function findProdutoId(int $idProduto, int $idEmpresa)
    {
        return $this->ProdutosModel
        ->select('produtos.titulo, produtos.preco, produtos.arquivo, produtos.descricao, produtos.tabela_nutricional, C.nome AS CATEGORIA')
        ->join('produto_categoria PC', 'PC.id_produto = produtos.id', 'left')
        ->join('categorias C', 'C.id = PC.id_categoria', 'left')
        ->where('produtos.id_empresa', $idEmpresa)
        ->where('produtos.id', $idProduto)
        ->where('PC.id_empresa', $idEmpresa)
        ->first();
    }

}
