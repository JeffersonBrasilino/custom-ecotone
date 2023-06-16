<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators\Pt_BR;

use Frete\Core\Domain\Validators\Validator;

class OptionalPhoneValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        if (empty($input)) {
            $this->isValid = true;
            return $this->isValid;
        }

        preg_match('/(\+[0-9]{2})?(([(][0-9]{2}[)])?([0-9]{2})?)9?[0-9]{4}-?[0-9]{4}/', $input, $matches);
        $this->isValid = $input === $matches[0];
        return $this->isValid;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid phone number' : null;
    }
}
