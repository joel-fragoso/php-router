<?php declare(strict_types=1);

namespace Prix\Tests;

use PHPUnit\Framework\TestCase;
use Prix\Router;

final class RouterTest extends TestCase
{
	private $router;

	public function setUp(): void
	{
		$this->router = new Router();
	}

	public function testCreateRouter(): void
	{
		$this->router->addRoute('/', function () {
			echo 'Test';
		});

		$dispatch = $this->router->dispatch('/');

		$this->assertEquals('Test', 'Test');
	}
}
