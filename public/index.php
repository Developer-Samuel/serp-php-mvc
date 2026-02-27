<?php

declare(strict_types=1);

use App\Kernel;

/**
 * |--------------------------------------------------------------------------
 * | Bootstrap The Application
 * |--------------------------------------------------------------------------
*/
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->getContainer()->get(Kernel::class);
$kernel->handle();