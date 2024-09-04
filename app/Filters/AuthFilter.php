<?php

namespace App\Filters;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeader('Authorization');
		$response = \Config\Services::response();
        if (!$authHeader) {
            return $response->setStatusCode(401, 'Token ausente.');
        }

        $token = str_replace('Bearer ', '', $authHeader->getValue());

        try {
            $key = env('CI_KEY');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // Armazena o ID da empresa na sessão
            $session = \Config\Services::session();
            $session->set('empresaId', $decoded->uid);
        } catch (\Exception $e) {
            return $response->setStatusCode(401, 'Token inválido.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não necessário neste caso
    }
}
