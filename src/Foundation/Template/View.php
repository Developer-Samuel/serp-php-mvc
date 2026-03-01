<?php

declare(strict_types=1);

namespace App\Foundation\Template;

use App\Foundation\{
    Application,
    Assets\Resolver\AssetPathResolver,
    Assets\Vite
};

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
     * 
     * @throws \RuntimeException
    */
    public function render(string $view, array $data = []): void
    {
        $path = $this->paths . '/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($path)) {
            throw new \RuntimeException(sprintf('View %s not found.', $view));
        }

        extract($data, EXTR_SKIP);

        require $path;
    }

    /**
     * @param string $path
     * 
     * @return string
    */
    public static function vite(string $path): string
    {        
        $resolvedPath = AssetPathResolver::resolve($path);
        
        return self::getViteInstance()->asset($resolvedPath);
    }

    /**
     * @param string $path
     * 
     * @return string
    */
    public static function viteCss(string $path): string
    {
        $resolvedPath = AssetPathResolver::resolve($path);

        return self::getViteInstance()->css($resolvedPath);
    }

    /**
     * @param mixed $page
     * 
     * @return string
    */
    public static function inertiaPage(mixed $page): string
    {
        return htmlspecialchars(
            json_encode($page, JSON_THROW_ON_ERROR),
            ENT_QUOTES,
            'UTF-8'
        );
    }

    /**
     * @return Vite
     * 
     * @throws \RuntimeException
    */
    private static function getViteInstance(): Vite
    {
        $vite = Application::getInstance()->getContainer()->get(Vite::class);
        if (!$vite instanceof Vite) {
            throw new \RuntimeException(sprintf(
                'Instance [%s] not found in DI container.', 
                Vite::class
            ));
        }

        return $vite;
    }
}