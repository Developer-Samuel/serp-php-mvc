<?php

declare(strict_types=1);

namespace App\Infrastructure\Client\Serper\Adapter\Contract;

interface SerperClientContract
{
    /**
     * @param string $keyword
     * @param string $url
     * @param string $key
     * 
     * @return array<mixed>|null
    */
    public function search(string $keyword, string $url, string $key): ?array;
}