<?php declare(strict_types=1);

namespace Prix;

use Closure;
use Prix\Exception\InvalidArgumentException;
use call_user_func;

final class Router
{
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

		$this->routes[$id] = $callback;
	}

	/**
	 * @var string $id
	 *
	 * @return mixed
	 */
	public function dispatch(string $id)
	{
		$id = $this->parserId($id);

		if (!isset($this->routes[$id])) {
			throw new InvalidArgumentException("The route ({$id}) does not exist", 400);
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
