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

        $this->isValid = (new PhoneValidator())->validate($input);

        return $this->isValid;
    }

    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid phone number' : null;
    }
}
