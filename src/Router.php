<?php declare(strict_types=1);

namespace Prix;

use Closure;
use Prix\Exception\InvalidArgumentException;

final class Router
{
	private $routes = [];

	public function addRoute(string $id, Closure $callback)
	{
		$id = $this->parserId($id);

		$this->routes[$id] = $callback;
	}

	public function dispatch(string $id)
	{
		if (!isset($this->routes[$id])) {
			throw new InvalidArgumentException("The route ({$id}) does not exist", 400);
		}

		$id = $this->parserId($id);

		$callback = $this->routes[$id];

		$callback();
	}

	private function parserId(string $id): string
	{
		return '/' . trim($id, '/');
	}
}
