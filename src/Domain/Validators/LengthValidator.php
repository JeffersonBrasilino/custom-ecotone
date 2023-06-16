<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class LengthValidator extends Validator
{
    private bool $isValid = false;

    public function __construct(private int $minLength, private int $maxLength)
    {
    }

    public function validate(mixed $input): bool
    {
        $inputLen = strlen($input);
        $this->isValid = $inputLen >= $this->minLength && $inputLen <= $this->maxLength;
        return $this->isValid;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid length' : null;
    }
}
