<?php

declare(strict_types=1);

namespace App\Domain\Pokemon\Exception;

use App\Application\Exception\ValidationException;

class FetcherJsonResponseValidationException extends ValidationException
{
    public function __construct(string $message = 'Error during json validation of the api response', ?\Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
