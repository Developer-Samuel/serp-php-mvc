<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Services;

use PHPUnit\{
    Framework\Attributes\CoversClass,
    Framework\MockObject\MockObject,
    Framework\TestCase
};

use App\Infrastructure\{
    Client\Serper\Adapter\Contract\SerperClientContract,
    Client\Serper\Connection\Contract\SerperConnectionContract,
    Client\Serper\Factory\Contract\SerperConnectionFactoryContract,
    Client\Serper\Mapper\Contract\SerperResponseMapperContract
};

use App\Application\Services\ScraperService;

#[CoversClass(ScraperService::class)]
class ScraperServiceTest extends TestCase
{
    private SerperClientContract&MockObject $client;
    private SerperResponseMapperContract&MockObject $mapper;
    private SerperConnectionFactoryContract&MockObject $factory;

    /**
     * @return void
    */
    protected function setUp(): void
    {
        parent::setUp();

        $this->initMocks();
    }
    
    /**
     * Method: scrape()
     * 
     * @return void
    */
    public function testScrapeReturnsMappedResultsWhenApiReturnsData(): void
    {
        $this->mockFactorySearch($this->createValidConnectionMock());
        $this->mockClientSearch(['organic' => $this->makeOrganicResult()]);
        $this->mockMapperExtract([$this->makeOrganicResult()]);

        $result = $this->runScrape();

        self::assertSame(200, $result['status']);
        self::assertNotEmpty($result['data']);
    }

    /**
     * Method: scrape()
     * 
     * @return void
    */
    public function testScrapeReturnsErrorWhenConnectionInvalid(): void
    {
        $connection = $this->createMock(SerperConnectionContract::class);
        $connection->method('isInvalid')->willReturn(true);

        $this->mockFactorySearch($connection);

        $result = $this->runScrape();

        self::assertSame(500, $result['status']);
    }

    /**
     * Method: scrape()
     * 
     * @return void
    */
    public function testScrapeReturnsErrorWhenResponseIsNull(): void
    {
        $this->mockFactorySearch($this->createValidConnectionMock());
        $this->mockClientSearch(null);

        $result = $this->runScrape();

        self::assertSame(502, $result['status']);
    }

    /**
     * Method: scrape()
     * 
     * @return void
    */
    public function testScrapeReturnsErrorWhenResultsEmpty(): void
    {
        $this->mockFactorySearch($this->createValidConnectionMock());
        $this->mockClientSearch(['organic' => []]);
        $this->mockMapperExtract([]);

        $result = $this->runScrape();

        self::assertSame(404, $result['status']);
    }

    /**
     * Method: scrape()
     * 
     * @return void
     * 
     * @throws \RuntimeException
    */
    public function testScrapeThrowsExceptionAndLogsIt(): void
    {
        $this->expectException(\RuntimeException::class);

        $this->factory
            ->method('search')
            ->willThrowException(new \RuntimeException('Boom'));

        $this->runScrape();
    }

    /**
     * @return void
    */
    private function initMocks(): void
    {
        $this->client  = $this->createMock(SerperClientContract::class);
        $this->mapper  = $this->createMock(SerperResponseMapperContract::class);
        $this->factory = $this->createMock(SerperConnectionFactoryContract::class);
    }

    /**
     * @return ScraperService
    */
    private function buildService(): ScraperService
    {
        return new ScraperService(
            $this->client,
            $this->mapper,
            $this->factory,
        );
    }

    /**
     * @param mixed $returnValue
     * 
     * @return void
    */
    private function mockFactorySearch(mixed $returnValue): void
    {
        $this->factory
            ->method('search')
            ->willReturn($returnValue);
    }

    /**
     * @param mixed $returnValue
     * 
     * @return void
    */
    private function mockClientSearch(mixed $returnValue): void
    {
        $this->client
            ->method('search')
            ->willReturn($returnValue);
    }

    /**
     * @param mixed $returnValue
     * 
     * @return void
    */
    private function mockMapperExtract(mixed $returnValue): void
    {
        $this->mapper
            ->method('extract')
            ->willReturn($returnValue);
    }

    /**
     * @return SerperConnectionContract&MockObject
    */
    private function createValidConnectionMock(): SerperConnectionContract&MockObject
    {
        $connection = $this->createMock(SerperConnectionContract::class);

        $connection->method('isInvalid')->willReturn(false);
        $connection->method('getUrl')->willReturn('https://api.test');
        $connection->method('getKey')->willReturn('test-key');

        return $connection;
    }

    /**
     * @return array<int, array<string, string>>
    */
    private function makeOrganicResult(): array
    {
        return [
            [
                'title' => 'Test',
                'link' => 'https://example.com',
                'description' => 'Desc',
            ],
        ];
    }

    /**
     * @return array<string, mixed>
    */
    private function runScrape(): array
    {
        return $this->buildService()->scrape('php');
    }
}