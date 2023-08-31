<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validator;

class BooleanValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        $this->isValid = is_bool($input);

        return $this->isValid;
    }

    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid boolean' : null;
    }
}
