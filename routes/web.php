<?php

declare(strict_types=1);

use App\Core\Routing\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/test', [HomeController::class, 'test']);
