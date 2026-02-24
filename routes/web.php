<?php

declare(strict_types=1);

use App\Foundation\Routing\Route;

use App\Application\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/test', [HomeController::class, 'test']);
