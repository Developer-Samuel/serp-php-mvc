<?php

declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/vendor/autoload.php';

use App\Foundation\Bootstrap\EnvLoader;

/*
|--------------------------------------------------------------------------
| Bootstrap Environment
|--------------------------------------------------------------------------
*/

EnvLoader::load(BASE_PATH);