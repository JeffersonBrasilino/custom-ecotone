<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Errors;

class DomainError extends \Exception
{
    public function __construct(
        string $message,
        int $code = 1,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
