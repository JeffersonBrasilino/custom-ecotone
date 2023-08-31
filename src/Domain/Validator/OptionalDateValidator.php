<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validator;

class OptionalDateValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        if (null === $input) {
            $this->isValid = true;

            return $this->isValid;
        }
        $this->isValid = (new DateValidator())->validate($input);

        return $this->isValid;
    }

    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid date format' : null;
    }
}
