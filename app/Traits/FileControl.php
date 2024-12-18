<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Storage;

trait FileControl
{
    use ApiResponse;

    /**
     * @throws Exception
     */
    public function uploadFiles($files, $path = 'images/', $disk = 'public'): array
    {
        $uploadedFiles = [];
        $files = is_array($files) ? $files : [$files];
        foreach ($files as $file) {
            if (!$file->isValid()) {
                throw new Exception('Upload files failed.');
            }
            $uploadedFiles[] = Storage::disk($disk)->putFile($path, $file);
        }
        return $uploadedFiles;
    }

    /**
     * @throws Exception
     */
    public function deleteFiles($files, $disk = 'public'): void
    {
        $files = is_array($files) ? $files : [$files];
        foreach ($files as $file) {
            if (!Storage::disk($disk)->exists($file)) {
                throw new Exception("Files does not exist.");
            }
            if (!Storage::disk($disk)->delete($file)) {
                throw new Exception("Delete files failed.");
            }
        }
    }

    /**
     * @throws Exception
     */
    public function downloadFiles($files, $disk = 'public'): void
    {
        $files = is_array($files) ? $files : [$files];
        foreach ($files as $file) {
            if (!Storage::disk($disk)->exists($file)) {
                throw new Exception("Files does not exist.");
            }
            if (!Storage::disk($disk)->download($file)) {
                throw new Exception("Download files failed.");
            }
        }
    }

    /**
     * @throws Exception
     */
    public function renameFile($fileName, $fileNewName, $disk = 'public'): void
    {
        if (Storage::disk($disk)->exists($fileName)) {
            Storage::disk($disk)->move($fileName, $fileNewName);
        } else {
            throw new Exception("File does not exist.");
        }
    }
}
