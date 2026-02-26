<?php

declare(strict_types=1);

namespace App\Application\Exceptions;

use App\Foundation\Http\Inertia\Inertia;

final class Handler
{
    /**
     * @param $message|null
     * 
     * @return void
    */
    public static function notFound(?string $message = 'Page not found'): void
    {
        http_response_code(404);

        Inertia::render(
            'Errors/NotFound',
            [
                'message' => $message
            ]
        );
        
        exit;
    }
}