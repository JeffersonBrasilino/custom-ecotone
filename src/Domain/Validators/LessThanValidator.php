<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class LessThanValidator extends Validator
{
    private bool $isValid = false;

    public function __construct(private int $max)
    {
    }

    public function validate(mixed $input): bool
    {
        $this->isValid = (is_float($input) || is_int($input)) && $input < $this->max;

        return $this->isValid;
    }

    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? "The value must be numeric and less than {$this->max}" : null;
    }
}
