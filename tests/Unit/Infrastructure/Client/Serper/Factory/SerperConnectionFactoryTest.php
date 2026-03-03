<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Client\Serper\Factory;

use PHPUnit\{
    Framework\Attributes\CoversClass,
    Framework\TestCase
};

use Tests\Support\Workspace\RecursivelyRemovesDirectories;

use App\Infrastructure\{
    Client\Serper\Connection\SerperConnection,
    Client\Serper\Factory\SerperConnectionFactory
};

#[CoversClass(SerperConnectionFactory::class)]
class SerperConnectionFactoryTest extends TestCase
{
    use RecursivelyRemovesDirectories;

    private string $tempDir;

    /**
     * @return void
    */
    protected function setUp(): void
    {
        parent::setUp();

        $this->initializeTempDirectory();
    }

    /**
     * @return void
    */
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->removeDirectory($this->tempDir);
    }

    /**
     * Method: search()
     * 
     * @return void
    */
    public function testReturnsEmptyConnectionWhenConfigFileDoesNotExist(): void
    {
        $factory = new SerperConnectionFactory();

        $connection = $factory->search($this->tempDir);

        $this->assertInstanceOf(SerperConnection::class, $connection);
        $this->assertTrue($connection->isInvalid());
    }

    /**
     * Method: search()
     * 
     * @return void
    */
    public function testReturnsValidConnectionWhenConfigIsCorrect(): void
    {
        $this->createConfig([
            'serper' => [
                'url' => 'http://localhost',
                'key' => 'secret'
            ]
        ]);

        $factory = new SerperConnectionFactory();

        $connection = $factory->search($this->tempDir);

        $this->assertSame('http://localhost', $connection->getUrl());
        $this->assertSame('secret', $connection->getKey());
        $this->assertFalse($connection->isInvalid());
    }

    /**
     * Method: search()
     * 
     * @return void
    */
    public function testReturnsEmptyConnectionWhenConfigIsNotArray(): void
    {
        $this->createInvalidConfig();

        $factory = new SerperConnectionFactory();
        $connection = $factory->search($this->tempDir);

        $this->assertTrue($connection->isInvalid());
    }

    /**
     * Method: search()
     * 
     * @return void
    */
    public function testReturnsEmptyConnectionWhenSerperIsNotArray(): void
    {
        $this->createConfig([
            'serper' => 'invalid'
        ]);

        $factory = new SerperConnectionFactory();
        $connection = $factory->search($this->tempDir);

        $this->assertTrue($connection->isInvalid());
    }

    /**
     * @return void
    */
    private function initializeTempDirectory(): void
    {
        $this->tempDir = sys_get_temp_dir() . '/serper_factory_test_' . uniqid();

        mkdir($this->tempDir . '/config', 0777, true);
    }

    /**
     * @param array<string, mixed> $data
     * 
     * @return void
    */
    private function createConfig(array $data): void
    {
        file_put_contents(
            $this->tempDir . '/config/api.php',
            '<?php return ' . var_export($data, true) . ';'
        );
    }

    /**
     * @return void
    */
    private function createInvalidConfig(): void
    {
        file_put_contents(
            $this->tempDir . '/config/api.php',
            '<?php return "invalid";'
        );
    }
}