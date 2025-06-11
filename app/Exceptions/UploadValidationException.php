<?php

declare(strict_types=1);

namespace App\Exceptions;

class UploadValidationException extends \Exception
{
    protected $message = 'Upload validation failed.';
}
