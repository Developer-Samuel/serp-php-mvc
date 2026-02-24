<?php

declare(strict_types=1);

namespace App\Core\Routing;

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

        $route = $routes[$uri] ?? null;
        if (!$route) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        [$controllerClass, $controllerMethod] = $route;

        $controller = new $controllerClass();
        $controller->$controllerMethod();
    }
}