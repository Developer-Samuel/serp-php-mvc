<?php

declare(strict_types=1);

namespace App\Foundation\Http\Abstract;

use App\Foundation\Template\View;

abstract class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View(BASE_PATH . '/views');
    }
}