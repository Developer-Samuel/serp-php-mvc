<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap/app.php';
require_once BASE_PATH . '/vendor/autoload.php';

use App\Foundation\Routing\Router;

use App\Kernel;

/*
|--------------------------------------------------------------------------
| Run Application
|--------------------------------------------------------------------------
*/
$router = new Router();

(new Kernel(new Router()))->handle();