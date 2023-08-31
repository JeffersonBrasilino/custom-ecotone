<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validator;

abstract class Validator
{
    abstract public function validate(mixed $input): bool;

    /**
     * @template T of string|array|null
     * @return T
     */
    abstract public function getErrorMessage(): string|array|null;
}
