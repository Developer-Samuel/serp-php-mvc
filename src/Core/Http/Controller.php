<?php

declare(strict_types=1);

namespace App\Core\Http;

use App\Core\Template\View;

abstract class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View(BASE_PATH . '/resources/views');
    }
}