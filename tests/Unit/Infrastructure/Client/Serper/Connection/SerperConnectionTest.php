<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Client\Serper\Connection;

use PHPUnit\{
    Framework\Attributes\CoversClass,
    Framework\TestCase
};

use App\Infrastructure\Client\Serper\Connection\SerperConnection;

#[CoversClass(SerperConnection::class)]
class SerperConnectionTest extends TestCase
{
    /**
     * Method: __construct() + getUrl() + getKey() + isInvalid()
     * 
     * @return void
    */
    public function testConnectionReturnsValidValues(): void
    {
        $connection = new SerperConnection('url', 'key');

        $this->assertSame('url', $connection->getUrl());
        $this->assertSame('key', $connection->getKey());
        $this->assertFalse($connection->isInvalid());
    }

    /**
     * Method: isInvalid()
     * 
     * @return void
    */
    public function testIsInvalidReturnsTrueWhenUrlIsEmpty(): void
    {
        $connection = new SerperConnection('', 'key');

        $this->assertTrue($connection->isInvalid());
    }

    /**
     * Method: isInvalid()
     * 
     * @return void
    */
    public function testIsInvalidReturnsTrueWhenKeyIsEmpty(): void
    {
        $connection = new SerperConnection('url', '');

        $this->assertTrue($connection->isInvalid());
    }
}