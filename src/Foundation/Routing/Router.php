<?php

declare(strict_types=1);

namespace App\Foundation\Routing;

use App\Application\Exceptions\Handler;

/**
 * @phpstan-type RouteAction array{class-string, string}
 * @phpstan-type RouteCollection array<string, array<string, RouteAction>>
*/
final class Router
{
    /**
     * @var RouteCollection
    */
    private array $routes = [];

    /**
     * @param string $method
     * @param string $uri
     * @param RouteAction $action
     * 
     * @return void
    */
    public function add(string $method, string $uri, array $action): void
    {
        $this->routes[$method][$uri] = $action;
    }

    /**
     * @param string $uri
     * @param string $method
     * 
     * @return void
    */
    public function dispatch(string $uri, string $method): void
    {
        $routes = $this->routes[$method] ?? [];

        if (!array_key_exists($uri, $routes)) {
            Handler::notFound();
        }

        [$controllerClass, $controllerMethod] = $routes[$uri];

        $controller = new $controllerClass();
        $controller->$controllerMethod();
    }
}