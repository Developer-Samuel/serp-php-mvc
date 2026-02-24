<?php

declare(strict_types=1);

namespace App\Application\Http\Controllers;

use App\Foundation\{
    Http\Controller,
    Http\Inertia\Inertia
};

class HomeController extends Controller
{
    /**
     * @return void
    */
    public function index(): void
    {
        Inertia::render('Pages/Home');
    }

    /**
     * @return void
    */
    public function test(): void
    {
        Inertia::render('Pages/Test');
    }
}