<?php

declare(strict_types=1);

namespace App\Application\Services\Contract;

interface ScraperContract
{
    /**
     * @param string $keyword
     * 
     * @return ScrapeResult
    */
    public function scrape(string $keyword): array;
}