<?php

declare(strict_types=1);

namespace Tests\Support\Workspace;

trait RecursivelyRemovesDirectories
{
    protected string $workspacePath;

    /**
     * @param string $path
     * 
     * @return void
    */
    protected function removeDirectory(string $path): void
    {
        if (!is_dir($path)) {
            return;
        }

        foreach (scandir($path) ?: [] as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $fullPath = $path . '/' . $item;

            is_dir($fullPath)
                ? $this->removeDirectory($fullPath)
                : unlink($fullPath);
        }

        rmdir($path);
    }
}