<?php

namespace App\Services\Upload\Interfaces;

use Illuminate\Http\UploadedFile;

/**
 * Service Interface for Upload file
 */
interface UploadService
{
    /**
     * Upload a file
     * 
     * @param array $options (folder, fileName)
     */
    public function uploadFile(UploadedFile $file, array $options): array;

    /**
     * Delete a file
     */
    public function deleteFile(string $path): bool;

    /**
     * Delete a folder
     */
    public function deleteFolder(string $path): bool;
}
