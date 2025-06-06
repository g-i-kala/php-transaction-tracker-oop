<?php

declare(strict_types=1);

namespace App;

class UploadValidator
{
    protected const DEFAULT_MAX_SIEZE = 3145728;
    protected $errors = [];

    public function __construct(
        protected $file,
        protected $maxSize = self::DEFAULT_MAX_SIEZE,
        protected array $allowedTypes = []
    ) {
        //
    }

    public function validate(): bool
    {
        $this->errors = [];

        if (!$this->checkIfExists()) {
            return false;
        }
        if (!$this->checkFileSize()) {
            return false;
        }
        if (!$this->checkFileType()) {
            return false;
        }

        return empty($this->errors);
    }

    public function checkIfExists()
    {
        if (!isset($this->file) || empty($this->file) || empty($this->file['tmp_name'])) {
            $this->errors['file'] = "Pick a file!";
            return false;
        }
        return true;
    }

    public function checkFileSize()
    {
        $fileSize = $this->file['tmp_name'] ? filesize($this->file['tmp_name']) : 0;

        if ($fileSize === 0) {
            $this->errors['file_size'] = "The file size is zero!";
            return false;
        }

        if ($fileSize > $this->maxSize) {
            $this->errors['file_size'] = "The file exceeds the 3MB limit";
            return false;
        }

        return true;
    }

    public function checkFileType()
    {
        if (empty($this->file['tmp_name'])) {
            $this->errors['file_type'] = "Invalid file provided";
            return false;
        }

        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $this->file['tmp_name']);
        finfo_close($fileinfo);

        if (!in_array($filetype, array_keys($this->allowedTypes))) {
            $this->errors['file_type'] = "The file type is incorrect";
            return false;
        }

        return true;
    }


    public function getErrors()
    {
        return $this->errors;
    }
}
