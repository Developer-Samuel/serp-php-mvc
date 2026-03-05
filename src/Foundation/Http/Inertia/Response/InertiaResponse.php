<?php

declare(strict_types=1);

namespace App\Foundation\Http\Inertia\Response;

use App\Foundation\Http\Inertia\Headers\InertiaHeaders;

use App\Application\View\InertiaPage;

final class InertiaResponse
{
    /**
     * @param InertiaPage $page
     * 
     * @return void
    */
    public static function send(InertiaPage $page): void
    {
        if (self::isInertiaRequest()) {
            self::sendJsonResponse($page);
            return;
        }

        self::renderView($page);
    }

    /**
     * @return bool
    */
    private static function isInertiaRequest(): bool
    {
        return isset($_SERVER['HTTP_X_INERTIA']);
    }

    /**
     * @param InertiaPage $page
     * 
     * @return void
    */
    private static function sendJsonResponse(InertiaPage $page): void
    {
        InertiaHeaders::send();

        echo json_encode($page);
        exit;
    }

    /**
     * @param InertiaPage $page
     * 
     * @return void
    */
    private static function renderView(InertiaPage $page): void
    {
        $_SERVER['INERTIA_PAGE'] = $page;

        include BASE_PATH . '/views/app.php';

        exit;
    }
}