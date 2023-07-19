<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class StringValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        $this->isValid = is_string($input);

        return $this->isValid;
    }

    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid string' : null;
    }
}
