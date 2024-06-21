<?php

declare(strict_types=1);

namespace App\Application\Exception;

class ValidationException extends \Exception
{
    public function __construct(string $message = 'Error during validation', ?\Throwable $previous = null)
    {
        parent::__construct(message: $message, previous: $previous);
    }
}
