<?php declare(strict_types=1);

namespace Prix\Tests;

use PHPUnit\Framework\TestCase;
use Prix\Router;
use Prix\Exception\RouteAlreadyExistException;
use Prix\Exception\RouteNotFoundException;

/**
 * Class RouterTest
 * @group RouterTest
 * @author Joel Fragoso <joelfragoso85@icloud.com>
 */
final class RouterTest extends TestCase
{
	public function testCreateRouter(): void
	{
		$router = new Router();

		$router->addRoute('/', function () {
			echo 'Test';
		});

		$this->assertObjectHasAttribute('routes', $router);
	}

	public function testRouteAlreadyExist(): void
	{
		$router = new Router();

		$router->addRoute('/test', function () {
			echo 'Test';
		});

		$this->expectException(RouteAlreadyExistException::class);

		$router->addRoute('/test', function () {
			echo 'Test';
		});

		$router->dispatch('/test');
	}

	public function testRouteNotFound(): void
	{
		$router = new Router();

		$router->addRoute('/', function () {
			echo 'Test';
		});

		$this->expectException(RouteNotFoundException::class);

		$router->dispatch('/test');
	}
}
