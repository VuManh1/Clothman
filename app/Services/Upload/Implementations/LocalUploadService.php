<?php

namespace App\Services\Upload\Implementations;

use App\Services\Upload\Interfaces\UploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LocalUploadService implements UploadService
{
    public function uploadFile(UploadedFile $file, array $options): array {
        $path = $file->store($options['folder']);

        return [
            'path' => $path,
        ];
    }

    public function deleteFile(string $path): bool {
        Storage::delete($path);

        return true;
    }
}
