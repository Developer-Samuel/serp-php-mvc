<?php

declare(strict_types=1);

namespace App\Application\Services\Contract;

/**
 * @phpstan-type OrganicItem array{
 *     title: string,
 *     link: string,
 *     description: string
 * }
 * 
 * @phpstan-type ScrapeResult array{
 *     data: array<int, OrganicItem>|array{
 *         error: string
 *     },
 *     status: int
 * }
*/
interface ScraperContract
{
    /**
     * @param string $keyword
     * 
     * @return ScrapeResult
    */
    public function scrape(string $keyword): array;
}