<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controller;

use App\Http\Inertia;

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