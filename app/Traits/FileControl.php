<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Storage;

trait FileControl
{
    /**
     * @throws Exception
     */
    public function uploadFiles($files, $path = 'images/', $disk = 'public'): array
    {
        if (empty($files)) {
            throw new Exception('No files provided for uploading.');
        }
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
    public function deleteFiles($files, $disk = 'public'): array
    {
        if (empty($files)) {
            throw new Exception('No files provided for deleting.');
        }
        $deletedFiles = [];
        $files = is_array($files) ? $files : [$files];
        foreach ($files as $file) {
            if (!Storage::disk($disk)->exists($file)) {
                throw new Exception("Files does not exist.");
            }
            if (!$deletedFiles[] = Storage::disk($disk)->delete($file)) {
                throw new Exception("Delete files failed.");
            }
        }
        return $deletedFiles;
    }

    /**
     * @throws Exception
     */
    public function downloadFiles($files, $disk = 'public'): array
    {
        if (empty($files)) {
            throw new Exception('No files provided for downloading.');
        }
        $downloadedFiles = [];
        $files = is_array($files) ? $files : [$files];
        foreach ($files as $file) {
            if (!Storage::disk($disk)->exists($file)) {
                throw new Exception("Files does not exist.");
            }
            if (!$downloadedFiles[] = Storage::disk($disk)->download($file)) {
                throw new Exception("Download files failed.");
            }
        }
        return $downloadedFiles;
    }

    /**
     * @throws Exception
     */
    public function renameFile($fileName, $fileNewName, $disk = 'public')
    {
        if (Storage::disk($disk)->exists($fileName)) {
            Storage::disk($disk)->move($fileName, $fileNewName);
        } else {
            throw new Exception("File does not exist.");
        }
    }
}
