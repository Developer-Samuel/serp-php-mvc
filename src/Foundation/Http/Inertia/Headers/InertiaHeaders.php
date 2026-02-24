<?php

declare(strict_types=1);

namespace App\Foundation\Http\Inertia\Headers;

final class InertiaHeaders
{
    /**
     * @return void
    */
    public static function send(): void
    {
        header('Content-Type: application/json');
        header('X-Inertia: true');
        header('Vary: Accept');
    }
}