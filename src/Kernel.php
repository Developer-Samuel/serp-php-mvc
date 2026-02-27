<?php

declare(strict_types=1);

namespace App;

use App\Foundation\{
    Routing\Route,
    Routing\Router
};

final readonly class Kernel
{
    /**
     * @param Router $router
    */
    public function __construct(
        private Router $router
    ) {}

    /**
     * @return void
    */
    public function handle(): void
    {
        $this->loadRoutes();

        $path = $this->resolvePath();
        $method = $this->resolveMethod();

        $this->router->dispatch($path, $method);
    }

    /**
     * @return void
    */
    private function loadRoutes(): void
    {
        Route::init($this->router);

        require BASE_PATH . '/routes/web.php';
    }

    /**
     * @return string
    */
    private function resolvePath(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $parsed = parse_url((string) $uri, PHP_URL_PATH);

        return (is_string($parsed) && $parsed !== '') ? $parsed : '/';
    }

    /**
     * @return string
    */
    private function resolveMethod(): string
    {
        return (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }
}