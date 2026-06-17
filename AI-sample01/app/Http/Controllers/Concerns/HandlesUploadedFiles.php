<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesUploadedFiles
{
    protected function storeUploadedFile(?UploadedFile $file, string $directory): ?string
    {
        if (! $file) {
            return null;
        }

        return $file->store($directory, 'public');
    }

    protected function replaceUploadedFile(?string $currentPath, ?UploadedFile $file, string $directory): ?string
    {
        if (! $file) {
            return $currentPath;
        }

        $this->deleteUploadedFile($currentPath);

        return $this->storeUploadedFile($file, $directory);
    }

    protected function deleteUploadedFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
