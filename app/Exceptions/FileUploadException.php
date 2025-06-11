<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class FileUploadException extends Exception
{
    protected $message = "Failed to move uploaded file.";
}
