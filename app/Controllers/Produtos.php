<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Services\ProdutoService;
use Config\Services;

class Produtos extends ResourceController
{
    protected $modelName = 'App\Models\ProdutosModel';
    protected $format = 'json';
    protected $empresaId;
    protected $produtoService;

    public function __construct()
    {
        $session = Services::session();
        $this->empresaId = $session->get('empresaId');
        $this->produtoService = new ProdutoService();
    }

    // GET /produtos
    public function index()
    {
        $data = $this->produtoService->getProdutos($this->empresaId);

        return $this->respond($data);
    }

    // GET /produtos/{id}
    public function show($id = null)
    {
        $produto = $this->model->where('id_empresa', $this->empresaId)->find($id);
        if ($produto) {
            return $this->respond($produto);
        } else {
            return $this->failNotFound('Produto não encontrada');
        }
    }

    // POST /produtos
    public function create()
    {
        $data = $this->request->getJSON(true);

        $validationResult = $this->model->validateData($data);

        if ($validationResult !== true) {
            // Retornar erros de validação se houver
            return $this->fail($validationResult);
        }

        if ($this->model->insert($data)) {
            return $this->respondCreated($data);
        } else {
            // Se a inserção falhar, retornar uma resposta de falha genérica
            return $this->fail('Erro ao criar produto.');
        }
    }

    // PUT /produtos/{id}
    public function update($id = null)
    {
        // Obtém os dados de entrada
        $data = $this->request->getJSON(true);

        // Verifica se o registro existe
        $existingId = $this->model->where('id_empresa', $this->empresaId)->find($id);
        if (!$existingId) {
            // Se o registro não existir, retorna uma resposta de erro
            return $this->failNotFound('Produto não encontrada.');
        }

        // Valida os dados
        $validationResult = $this->model->validateData($data);

        if ($validationResult !== true) {
            // Retorna erros de validação se houver
            return $this->fail($validationResult);
        }

        // Atualiza o registro
        if ($this->model->where('id_empresa', $this->empresaId)->update($id, $data)) {
            return $this->respond($data);
        } else {
            // Se a atualização falhar, retorna uma resposta de falha genérica
            return $this->fail('Erro ao atualizar produto.');
        }
    }

    // DELETE /produtos/{id}
    public function delete($id = null)
    {
        // Valida se o ID é fornecido e válido
        if ($id === null || !is_numeric($id)) {
            return $this->fail('ID inválido.');
        }

        // Verifica se o registro existe
        $existingId = $this->model->find($id);
        if (!$existingId) {
            // Se o registro não existir, retorna uma resposta de erro
            return $this->failNotFound('Produto não encontrada.');
        }

        // Tenta excluir o registro
        if ($this->model->where('id_empresa', $this->empresaId)->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        } else {
            // Se a exclusão falhar, retorna uma resposta de falha
            return $this->failNotFound('Produto não encontrada');
        }
    }

    // Rotas externas

    // GET /externa/produtos
    public function todos()
    {
        $idEmpresa = $this->request->getHeaderLine('Id-Empresa');
        $data = $this->produtoService->getProdutos($idEmpresa);
        return $this->respond($data);
    }

    // GET /externa/produto/{id}
    public function produto($idProduto)
    {
        $idEmpresa = $this->request->getHeaderLine('Id-Empresa');
        $data = $this->produtoService->getProdutoId($idProduto, $idEmpresa);
        return $this->respond($data);
    }
}
