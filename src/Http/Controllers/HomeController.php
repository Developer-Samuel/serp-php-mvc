<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controller;

class HomeController extends Controller
{
    /**
     * @return void
    */
    public function index(): void
    {
        $this->view->render('home');
    }
}