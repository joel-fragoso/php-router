<?php declare(strict_types=1);

namespace Prix;

use Closure;
use Prix\Exception\RouteAlreadyExistException;
use Prix\Exception\RouteNotFoundException;
use call_user_func;

final class Router
{
	/**
	 * @var array $routes
	 */
	private $routes = [];

	/**
	 * @var string $id
	 * @var Closure $callback
   *
	 * @return void
	 */
	public function addRoute(string $id, Closure $callback): void
	{
		$id = $this->parserId($id);

		foreach ($this->routes as $key => $cb) {
			if ($key === $id) {
				throw new RouteAlreadyExistException("The route ({$id}) already exist.", 400);
			}
		}

		$this->routes[$id] = $callback;
	}

	/**
	 * @var string $id
	 *
	 * @return mixed
   * @throws RouteNotFoundException
	 */
	public function dispatch(string $id)
	{
		$id = $this->parserId($id);

		if (!isset($this->routes[$id])) {
			throw new RouteNotFoundException("The route ({$id}) does not exist.", 400);
		}

		$callback = $this->routes[$id];

		call_user_func($callback);
	}

	/**
	 * @var string $id
	 *
	 * @return string
	 */
	private function parserId(string $id): string
	{
		return '/' . trim($id, '/');
	}
}
