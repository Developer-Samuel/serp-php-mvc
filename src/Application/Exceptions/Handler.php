<?php

declare(strict_types=1);

namespace App\Application\Exceptions;

use App\Foundation\Http\Inertia\Inertia;

final class Handler
{
    /**
     * @return void
    */
    public static function notFound(): void
    {
        http_response_code(404);

        Inertia::render('Errors/NotFound');
        
        exit;
    }
}