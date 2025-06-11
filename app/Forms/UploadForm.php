<?php

declare(strict_types=1);

namespace App\Forms;

use App\Exceptions\UploadValidationException;
use App\UploadValidator;

class UploadForm
{
    protected $errors = [];

    public function __construct(private array $file)
    {
        if (!UploadValidator::checkIfExists($file)) {
            $this->errors['file'] = "Pick a file.";
        };

        if (!UploadValidator::checkFileSize($file)) {
            $this->errors['file_size'] = "The file exceeds the 3MB limit";
        };

        if (!UploadValidator::checkFileType($file, [
          'text/plain' => 'csv',
          'application/csv' => 'csv',
          'application/vnd.ms-excel/plain' => 'csv',
        ])) {
            $this->errors['file_type'] = "The file type is incorrect";
        };
    }

    public static function validate($file)
    {
        $instance = new self($file);
        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        return UploadValidationException::throw($this->getErrors(), $this->file);
    }

    public function failed()
    {
        return count($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError($field, $message)
    {
        $this->errors[$field] = $message;
        return $this;
    }

    public function sanitize()
    {
        //
    }

    public function valid(): bool
    {
        return ! $this->failed();
    }

    public function file(): array
    {
        return $this->file;
    }

}
