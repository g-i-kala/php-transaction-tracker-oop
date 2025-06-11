<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\FileUploadException;

class FileUploader
{
    public function __construct(protected $file)
    {

    }
    public function moveTo($storagePath)
    {
        $filename = pathinfo($this->file, PATHINFO_FILENAME);
        $targetPath = rtrim($storagePath, '/') . '/' . $filename . '.csv';

        if (!move_uploaded_file($this->file, $targetPath)) {
            throw new FileUploadException();
        }

        return $targetPath;
    }

}
