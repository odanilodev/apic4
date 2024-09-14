<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Services\CategoriaService;
use Config\Services;

class Categorias extends ResourceController
{
    protected $modelName = 'App\Models\CategoriasModel';
    protected $format = 'json';
    protected $empresaId;
    protected $categoriaService;

    public function __construct()
    {
        $session = Services::session();
        $this->empresaId = $session->get('empresaId');
        $this->categoriaService = new CategoriaService();
    }

    // GET /categorias
    public function index()
    {
        $data = $this->categoriaService->getCategorias($this->empresaId);

        return $this->respond($data);
    }

    // GET /categorias/{id}
    public function show($id = null)
    {
        $categoria = $this->model->where('id_empresa', $this->empresaId)->find($id);
        if ($categoria) {
            return $this->respond($categoria);
        } else {
            return $this->failNotFound('Categoria não encontrada');
        }
    }

    // POST /categorias
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
            return $this->fail('Erro ao criar categoria.');
        }
    }

    // PUT /categorias/{id}
    public function update($id = null)
    {
        // Obtém os dados de entrada
        $data = $this->request->getJSON(true);

        // Verifica se o registro existe
        $existingId = $this->model->where('id_empresa', $this->empresaId)->find($id);
        if (!$existingId) {
            // Se o registro não existir, retorna uma resposta de erro
            return $this->failNotFound('Categoria não encontrada.');
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
            return $this->fail('Erro ao atualizar categoria.');
        }
    }

    // DELETE /categorias/{id}
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
            return $this->failNotFound('Categoria não encontrada.');
        }

        // Tenta excluir o registro
        if ($this->model->where('id_empresa', $this->empresaId)->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        } else {
            // Se a exclusão falhar, retorna uma resposta de falha
            return $this->failNotFound('Categoria não encontrada');
        }
    }

    // Rotas externas

    // GET /externa/categorias
    public function todas()
    {
        $idEmpresa = $this->request->getHeaderLine('Id-Empresa');
        $data = $this->categoriaService->getCategorias($idEmpresa);
        return $this->respond($data);
    }
}
