<?php

declare(strict_types=1);

namespace App\Foundation\Assets\Enum;

enum AssetType: string
{
    case CSS = 'css';
    case SCSS = 'scss';
    case TYPESCRIPT = 'ts';
    case JAVASCRIPT = 'js';

    /**
     * @param string $path
     * 
     * @return self
     * 
     * @throws \InvalidArgumentException
    */
    public static function fromPath(string $path): self
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return match ($extension) {
            'css'  => self::CSS,
            'scss' => self::SCSS,
            'ts'  => self::TYPESCRIPT,
            'js'  => self::JAVASCRIPT,
            default => throw new \InvalidArgumentException('Unsupported extension: . ' . $extension),
        };
    }

    /**
     * @return string
    */
    public function getFolder(): string
    {
        return $this->value;
    }
}