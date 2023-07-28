<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;
class OptionalLengthValidator extends Validator
{
    private bool $isValid = false;

    public function __construct(private int $minLength, private int $maxLength)
    {
    }

    public function validate(mixed $input): bool
    {
        if (empty($input)) {
            $this->isValid = true;
            return $this->isValid;
        }

        $this->isValid = (new LengthValidator($this->minLength, $this->maxLength))->validate($input);
        return $this->isValid;
    }

    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid length' : null;
    }
}
