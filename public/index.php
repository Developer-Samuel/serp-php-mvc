<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';

use App\Kernel;

(new Kernel())->handle();