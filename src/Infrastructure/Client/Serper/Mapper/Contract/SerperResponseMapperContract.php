<?php

declare(strict_types=1);

namespace App\Infrastructure\Client\Serper\Mapper\Contract;

/**
 * @phpstan-type OrganicItem array{
 *     title: string,
 *     link: string,
 *     description: string
 * }
*/
interface SerperResponseMapperContract
{
    /**
     * @param array<string, mixed> $data
     * 
     * @return array<int, OrganicItem>
    */
    public function extract(array $data): array;
}