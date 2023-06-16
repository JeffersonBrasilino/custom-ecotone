<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class NotEmptyValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        $this->isValid = !empty($input);
        return $this->isValid;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Cannot be empty' : null;
    }
}
