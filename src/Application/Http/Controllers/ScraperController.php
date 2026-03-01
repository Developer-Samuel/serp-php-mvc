<?php

declare(strict_types=1);

namespace App\Application\Http\Controllers;

use App\Foundation\{
    Http\Request,
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
     * @param Request $request
     * 
     * @return void
    */
    public function scrape(Request $request): void
    {
        try {
            $scrapeRequest = ScrapeRequest::fromArray($request->data);

            $result = $this->service->scrape($scrapeRequest->keyword);

            JsonResponse::send(
                $result['data'],
                $result['status']
            );
        } catch (\InvalidArgumentException $e) {
            JsonResponse::send(
                ['error' => $e->getMessage()],
                400
            );
        } catch (\Throwable $throwable) {
            Log::app()->error('ScraperController failed', [
                'exception' => $throwable,
            ]);

            JsonResponse::send(
                ['error' => 'Something went wrong.'],
                500
            );
        }
    }
}