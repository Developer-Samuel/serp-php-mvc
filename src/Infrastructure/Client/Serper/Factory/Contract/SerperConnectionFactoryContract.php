<?php

declare(strict_types=1);

namespace App\Infrastructure\Client\Serper\Factory\Contract;

use App\Infrastructure\Client\Serper\Connection\Contract\SerperConnectionContract;

interface SerperConnectionFactoryContract
{
    /**
     * @param string $basePath
     * 
     * @return SerperConnectionContract
    */
    public function search(string $basePath): SerperConnectionContract;
}