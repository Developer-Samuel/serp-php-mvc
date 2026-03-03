<?php

declare(strict_types=1);

namespace Tests\Integration\Infrastructure\Client\Serper;

use PHPUnit\{
    Framework\Attributes\CoversClass,
    Framework\TestCase
};

use App\Infrastructure\Client\Serper\Adapter\SerperClient;

#[CoversClass(SerperClient::class)]
class SerperClientTest extends TestCase
{
    /**
     * Method: search()
     * 
     * @return void
    */
    public function testSearchReturnsArrayWhenApiReturnsValidJson(): void
    {
        $result = $this->runSearch('https://httpbin.org/post');

        $this->assertIsArray($result);
    }

    /**
     * Method: search()
     * 
     * @return void
    */
    public function testSearchReturnsNullWhenHttpCodeIsNotSuccess(): void
    {
        $result = $this->runSearch('https://httpbin.org/status/500');

        $this->assertNull($result);
    }

    /**
     * Method: search()
     * 
     * @return void
    */
    public function testSearchReturnsNullWhenCurlInitFails(): void
    {
        $result = $this->runSearch('https://invalid-domain.local');

        $this->assertNull($result);
    }

    /**
     * @param string $url
     * 
     * @return array<mixed>|null
    */
    private function runSearch(string $url): ?array
    {
        $client = new SerperClient();

        return $client->search(
            'php',
            $url,
            'test-key'
        );
    }
}