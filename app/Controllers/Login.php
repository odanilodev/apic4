<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Login extends ResourceController
{
	protected $format = 'json'; // Define o formato de resposta JSON
	protected $empresaModel;

	public function __construct()
	{
		$this->empresaModel = new \App\Models\EmpresasModel(); // Ajuste conforme seu modelo de empresa
	}

	// Função de login para gerar o JWT
	public function login()
	{
		$usuario = $this->request->getPost('usuario');
		$senha = $this->request->getPost('senha');

		// Valida se as credenciais foram enviadas
		if (!$usuario || !$senha) {
			return $this->fail('Usuario e senha são obrigatórios.');
		}

		// Verifica se a empresa existe
		$empresa = $this->empresaModel->where('usuario', $usuario)->first();

		//log_message('error',$empresa['senha']);

		if (!$empresa || !password_verify($senha, $empresa['senha'])) {
			return $this->failUnauthorized('Credenciais inválidas.');
		}

		// Gera o token JWT
		$key = env('CI_KEY');
		
		$payload = [
			'iat' => time(),
			'exp' => time() + 3600, // 1 hora de validade
			'uid' => $empresa['id'] // ID da empresa
		];

		$token = JWT::encode($payload, $key, 'HS256');

		return $this->respond(['token' => $token]);
	}
}
