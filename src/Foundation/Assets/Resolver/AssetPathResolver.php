<?php

declare(strict_types=1);

namespace App\Foundation\Assets\Resolver;

use App\Foundation\Assets\Enum\AssetType;

final class AssetPathResolver
{
    /**
     * @param string $path
     * 
     * @return string
     * 
     * @throws \InvalidArgumentException
    */
    public static function resolve(string $path): string
    {
        $type = AssetType::fromPath($path);
        
        return sprintf('resources/%s/%s', $type->getFolder(), $path);
    }
}