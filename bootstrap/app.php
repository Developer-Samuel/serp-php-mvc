<?php

declare(strict_types=1);

use App\Foundation\Application;

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/vendor/autoload.php';

return new Application(BASE_PATH);