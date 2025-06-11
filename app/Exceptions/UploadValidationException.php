<?php

declare(strict_types=1);

namespace App\Exceptions;

class UploadValidationException extends \Exception
{
    public $errors = [];
    protected $old = [];

    public static function throw($errors, $old): never
    {
        $instance = new self();
        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getOld(): array
    {
        return $this->old;
    }

}
