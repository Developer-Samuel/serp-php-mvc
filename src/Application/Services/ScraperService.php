<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Infrastructure\{
    Client\Serper\Adapter\SerperClient,
    Client\Serper\Connection\SerperConnection,
    Client\Serper\Mapper\SerperResponseMapper,
    Client\Serper\Provider\SerperConnectionProvider
};

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
final readonly class ScraperService
{
    /**
     * @param SerperClient $client
     * @param SerperResponseMapper $mapper
     * @param SerperConnectionProvider $provider
    */
    public function __construct(
        private SerperClient $client,
        private SerperResponseMapper $mapper,
        private SerperConnectionProvider $provider
    ) {}

    /**
     * @param string $keyword
     * 
     * @return ScrapeResult
    */
    public function scrape(string $keyword): array
    {
        $connection = $this->getConnection();
        if ($connection->isInvalid()) {
            return $this->errorResponse('API configuration is invalid', 500);
        }

        $response = $this->fetchResults($keyword, $connection);
        if ($response === null) {
            return $this->errorResponse('API communication failed', 502);
        }

        $results = $this->mapResults($response);
        if ($results === []) {
            return $this->errorResponse('No organic results found', 404);
        }

        return [
            'data' => $results,
            'status' => 200,
        ];
    }

    /**
     * @return SerperConnection
    */
    private function getConnection(): SerperConnection
    {
        return $this->provider->search(BASE_PATH);
    }

    /**
     * @param string $keyword
     * @param SerperConnection $connection
     * 
     * @return array<string, mixed>|null
    */
    private function fetchResults(string $keyword, SerperConnection $connection): ?array
    {
        /** @var array<string, mixed>|null $result */
        $result = $this->client->search(
            $keyword,
            $connection->getUrl(),
            $connection->getKey()
        );

        return $result;
    }

    /**
     * @param array<string, mixed> $response
     * 
     * @return array<int, OrganicItem>
    */
    private function mapResults(array $response): array
    {
        return $this->mapper->extract($response);
    }

    /**
     * @param string $message
     * @param int $status
     * 
     * @return ScrapeResult
    */
    private function errorResponse(string $message, int $status): array
    {
        return [
            'data' => [
                'error' => $message
            ],
            'status' => $status,
        ];
    }
}