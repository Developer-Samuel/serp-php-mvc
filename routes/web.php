<?php

declare(strict_types=1);

use App\Foundation\Routing\Route;

use App\Application\Http\{
    Controllers\HomeController,
    Controllers\ScraperController
};

Route::get('/', [HomeController::class, 'index']);
Route::post('/scrape', [ScraperController::class, 'scrape']);