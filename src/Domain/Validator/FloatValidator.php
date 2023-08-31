<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validator;

class FloatValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        $this->isValid = is_float($input);

        return $this->isValid;
    }

    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid float number' : null;
    }
}
