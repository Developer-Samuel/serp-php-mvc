<?php

declare(strict_types=1);

namespace App\Foundation\Routing;

/**
 * @phpstan-type RouteAction array{class-string, string}
*/
final class Route
{
    private static Router $router;

    /**
     * @param Router $router
     * 
     * @return void
    */
    public static function init(Router $router): void
    {
        self::$router = $router;
    }

    /**
     * @param string $uri
     * @param RouteAction $action
     * 
     * @return void
    */
    public static function get(string $uri, array $action): void
    {
        self::$router->add('GET', $uri, $action);
    }

    /**
     * @param string $uri
     * @param RouteAction $action
     * 
     * @return void
    */
    public static function post(string $uri, array $action): void
    {
        self::$router->add('POST', $uri, $action);
    }
}