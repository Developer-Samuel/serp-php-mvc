<?php

declare(strict_types=1);

namespace Tests\Support\Providers;

final class TestServiceProvider
{
    public static bool $called = false;

    /**
     * @return void
    */
    public function register(): void
    {
        self::$called = true;
    }
}