<?php

declare(strict_types=1);

use App\Foundation\Application;

require __DIR__ . '/constants.php';
require BASE_PATH . '/vendor/autoload.php';

return new Application(BASE_PATH);