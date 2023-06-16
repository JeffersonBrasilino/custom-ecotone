<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class GreaterThanValidator extends Validator
{
    private bool $isValid = false;

    public function __construct(private int $min)
    {
    }

    public function validate(mixed $input): bool
    {
        $this->isValid = (is_float($input) || is_int($input)) && ($input > $this->min);
        return $this->isValid;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? "Value must be numeric and greater than {$this->min}" : null;
    }
}
