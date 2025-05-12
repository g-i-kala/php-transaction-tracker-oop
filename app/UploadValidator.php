<?php

declare(strict_types=1);

namespace App;

class UploadValidator
{
    protected $errors = [];

    public function __construct(protected $file, protected $maxSize = 3145728, protected array $allowedTypes = [])
    {
        //
    }

    public function validate(): bool
    {
        $this->checkIfExists()
          ->checkFileSize()
          ->checkFileType();

        return empty($this->errors);
    }

    public function checkIfExists()
    {
        if (!isset($this->file)) {
            $this->errors['file'] = "The file does not exist";
        }
        return $this;
    }

    public function checkFileSize()
    {
        $fileSize = filesize($this->file['tmp_name']);

        if ($fileSize === 0) {
            $this->errors['file_size'] = "The file size is zero!";
        }

        if ($fileSize > $this->maxSize) {
            $this->errors['file_size'] = "The file exceeds the 3MB limit";
        }

        return $this;
    }

    public function checkFileType()
    {
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $this->file['tmp_name']);
        finfo_close($fileinfo);

        if (!in_array($filetype, array_keys($this->allowedTypes))) {
            $this->errors['file_type'] = "The file type is incorrect";
        }

        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
