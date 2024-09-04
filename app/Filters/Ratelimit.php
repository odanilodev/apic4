<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Ratelimit implements FilterInterface
{
	protected $maxRequests = 2; // Máximo de requisições permitidas
	protected $window = 3600; // Janela de tempo em segundos (1 hora)
	protected $cache;

	public function __construct()
	{
		// Obtenha o serviço de cache
		$this->cache = \Config\Services::cache();
	}

	/**
	 * Do whatever processing this filter needs to do.
	 * By default it should not return anything during
	 * normal execution. However, when an abnormal state
	 * is found, it should return an instance of
	 * CodeIgniter\HTTP\Response. If it does, script
	 * execution will end and that Response will be
	 * sent back to the client, allowing for error pages,
	 * redirects, etc.
	 *
	 * @param RequestInterface $request
	 * @param array|null       $arguments
	 *
	 * @return mixed
	 */
	public function before(RequestInterface $request, $arguments = null)
	{
		$ip = $request->getIPAddress();
		$key = 'rate_limit_' . $ip;
		$requests = $this->cache->get($key);

		if ($requests === null) {
			// Se não houver registros, inicie o contador
			$this->cache->save($key, 1, $this->window);
		} elseif ($requests >= $this->maxRequests) {
			// Se exceder o limite, retorne uma resposta de erro
			return service('response')
				->setStatusCode(ResponseInterface::HTTP_TOO_MANY_REQUESTS)
				->setBody('Excedeu limite de requisição');
		} else {
			// Caso contrário, atualize o contador
			$this->cache->save($key, $requests + 1, $this->window);
		}
	}

	/**
	 * Allows After filters to inspect and modify the response
	 * object as needed. This method does not allow any way
	 * to stop execution of other after filters, short of
	 * throwing an Exception or Error.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param array|null        $arguments
	 *
	 * @return mixed
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
