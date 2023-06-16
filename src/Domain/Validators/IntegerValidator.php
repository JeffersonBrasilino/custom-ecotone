<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class IntegerValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        $this->isValid = is_int($input);
        return $this->isValid;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid integer number' : null;
    }
}
