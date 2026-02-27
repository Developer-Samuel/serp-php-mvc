<?php

declare(strict_types=1);

namespace App\Application\Http\Controllers;

use App\Foundation\{
    Http\Response\JsonResponse,
    Logging\Log
};

use App\Application\{
    Http\Request\ScrapeRequest,
    Services\Contract\ScraperContract
};

final readonly class ScraperController
{
    /**
     * @param ScraperContract $service
    */
    public function __construct(
        private ScraperContract $service
    ) {}

    /**
     * @return void
    */
    public function scrape(): void
    {
        $request = ScrapeRequest::fromHttp();
        if ($request === null) {
            JsonResponse::send(['error' => 'Invalid request'], 400);
            return;
        }

        try {
            $result = $this->service->scrape($request->keyword);

            JsonResponse::send(
                $result['data'],
                $result['status']
            );
        } catch (\Throwable $throwable) {
            Log::app()->error('Controller failed', [
                'exception' => $throwable,
            ]);

            JsonResponse::send(
                ['error' => 'Internal Server Error'],
                500
            );
        }
    }
}