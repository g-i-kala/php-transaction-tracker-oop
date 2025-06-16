<?php

declare(strict_types=1);

namespace App;

class UploadValidator
{
    public static function checkIfExists(array $file): bool
    {
        return isset($file['tmp_name']) && is_uploaded_file($file['tmp_name']);
    }

    public static function checkFileSize($file, $maxSize = (1024 * 1024 * 3))
    {
        if (empty($file['tmp_name']) || !file_exists($file['tmp_name'])) {
            return false;
        };

        $fileSize = filesize($file['tmp_name']);
        return $fileSize > 0 && $fileSize <= $maxSize;
    }

    public static function checkFileType($file, array $allowedTypes = [])
    {
        if (empty($file['tmp_name']) || !file_exists($file['tmp_name'])) {
            return false;
        };

        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $file['tmp_name']);
        finfo_close($fileinfo);

        return in_array($filetype, array_keys($allowedTypes));
    }
}
