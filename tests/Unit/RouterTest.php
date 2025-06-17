<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Router;
use PHPUnit\Framework\TestCase;
use App\Exceptions\RouteNotFoundException;
use Tests\DataProviders\RouterDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;

class RouterTest extends TestCase
{
    private $router;

    public function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
    }
    public function test_it_can_register_a_route(): void
    {
        // we have a router

        // we register a route
        $this->router->register('get', '/users', ['Users', 'index']);
        // we assert thereis a route}
        $expected = [
          'get' => [
            '/users' => ['Users', 'index']
        ]
      ];

        $this->assertSame($expected, $this->router->routes());

    }

    public function test_it_can_register_a_get_route(): void
    {
        $this->router->get('/users', ['Users', 'index']);

        $expected = [
          'get' => [
            '/users' => ['Users', 'index']
        ]
      ];

        $this->assertSame($expected, $this->router->routes());
    }


    public function test_it_can_register_a_post_route(): void
    {
        $this->router->post('/users', ['Users', 'index']);

        $expected = [
          'post' => [
            '/users' => ['Users', 'index']
        ]
      ];

        $this->assertSame($expected, $this->router->routes());
    }

    public function test_no_routes_created_initially(): void
    {
        $this->assertEmpty($this->router->routes());
    }


    #[DataProviderExternal(RouterDataProvider::class, 'routeNotFoundCases')]
    public function test_it_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ): void {
        $users = new class () {
            public function delete()
            {
                return true;
            }
        };

        $this->router->post('/users', [$users::class, 'store']);
        $this->router->post('/users', ['Users', 'index']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);

    }

    public function test_it_resolves_route_from_a_closuer(): void
    {
        $this->router->get('/users', fn () => [1, 2, 3]);
        $this->assertSame(
            [1, 2, 3],
            $this->router->resolve('/users', 'get')
        );
    }

    public function test_it_resolves_route(): void
    {
        $users = new class () {
            public function index()
            {
                return [1, 2, 3];
            }
        };

        $this->router->get('/users', [$users::class, 'index']);
        $this->assertSame([1, 2, 3], $this->router->resolve('/users', 'get'));

    }

}
