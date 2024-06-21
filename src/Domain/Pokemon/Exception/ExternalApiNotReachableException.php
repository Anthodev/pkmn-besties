<?php

declare(strict_types=1);

namespace App\Domain\Pokemon\Exception;

use App\Application\Exception\InvalidArgumentException;

class ExternalApiNotReachableException extends InvalidArgumentException
{
    public function __construct(string $message = 'External API not reachable', ?\Throwable $previous = null)
    {
        parent::__construct(message: $message, previous: $previous);
    }
}
