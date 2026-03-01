<?php

declare(strict_types=1);

use App\Foundation\Template\View;

if (!function_exists('vite')) {
    /**
     * @param string $path
     * 
     * @return string
    */
    function vite(string $path): string
    {        
        return View::vite($path);
    }
}

if (!function_exists('vite_css')) {
    /**
     * @param string $path
     * 
     * @return string
    */
    function vite_css(string $path): string
    {
        return View::viteCss($path);
    }
}

if (!function_exists('inertia_page')) {
    /**
     * @param mixed $page
     * 
     * @return string
    */
    function inertia_page(mixed $page): string
    {
        return View::inertiaPage($page);
    }
}
