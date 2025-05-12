<?php

declare(strict_types=1);

namespace App;

class FileUploader
{
    public function __construct(protected $file)
    {

    }
    public function moveTo($storagePath)
    {
        $filename = basename($this->file);
        $targetPath = rtrim($storagePath, '/') . '/' . $filename . '.csv';

        if (!move_uploaded_file($this->file, $targetPath)) {
            throw new \Exception("Failed to move uploaded file.");
        }

        return $targetPath;
    }
}
