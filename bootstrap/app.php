<?php

declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/vendor/autoload.php';

use App\Foundation\{
    Bootstrap\EnvLoader,
    Logging\Log
};

use App\Infrastructure\Logging\MonologLogger;

/**
 * |--------------------------------------------------------------------------
 * | Bootstrap Environment
 * |--------------------------------------------------------------------------
*/

EnvLoader::load(BASE_PATH);

/*
|--------------------------------------------------------------------------
| Bootstrap Logger
|--------------------------------------------------------------------------
*/

$logger = new MonologLogger(
    BASE_PATH . '/storage/logs/app.log',
    'app'
);

Log::init($logger);