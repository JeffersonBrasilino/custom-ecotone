<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class OptionalFloatValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        if (null === $input) {
            $this->isValid = true;
            return $this->isValid;
        }
        $this->isValid = (new FloatValidator())->validate($input);
        return $this->isValid;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid float number' : null;
    }
}
