<?php

declare(strict_types=1);

namespace App\Core\Template;

final class View
{
    private string $paths;

    /**
     * @param string $paths
    */
    public function __construct(string $paths)
    {
        $this->paths = rtrim($paths, '/');
    }

    /**
     * @param string $view
     * @param array<string, mixed> $data
     * 
     * @return void
    */
    public function render(string $view, array $data = []): void
    {
        $path = $this->paths . '/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($path)) {
            throw new \RuntimeException("View {$view} not found.");
        }

        extract($data, EXTR_SKIP);

        require $path;
    }
}