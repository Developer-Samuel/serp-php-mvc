<?php

declare(strict_types=1);

use App\Foundation\Bootstrap\Env;

return [
    'serper' => [
        'url' => Env::get('SERPER_API_URL', 'https://google.serper.dev/search'),
        'key' => Env::get('SERPER_API_KEY', ''),
    ],
];