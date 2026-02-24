<?php

declare(strict_types=1);

namespace App\Http\Response;

final class InertiaResponse
{
    /**
     * @param array $page
     * 
     * @return void
    */
    public static function send(array $page): void
    {
        if (isset($_SERVER['HTTP_X_INERTIA'])) {
            header('Content-Type: application/json');
            header('X-Inertia: true');
            header('Vary: Accept');

            echo json_encode($page);
            exit;
        }

        $_SERVER['INERTIA_PAGE'] = $page;

        include BASE_PATH . '/resources/views/app.php';

        exit;
    }
}