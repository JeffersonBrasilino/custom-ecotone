<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class EmailValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        $this->isValid = (bool) filter_var($input, FILTER_VALIDATE_EMAIL);

        return $this->isValid;
    }

    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid email address' : null;
    }
}
