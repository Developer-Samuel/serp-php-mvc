<?php

declare(strict_types=1);

namespace App\Support;

trait Arrayable
{
    /**
     * @return array<mixed>
    */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}