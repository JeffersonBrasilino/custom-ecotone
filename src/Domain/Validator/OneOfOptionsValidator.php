<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validator;

class OneOfOptionsValidator extends Validator
{
    private bool $isValid = false;

    public function __construct(private array $validOptions = [])
    {
    }

    public function setOptions(array $options): mixed
    {
        $this->validOptions = $options;

        return $this;
    }

    public function validate(mixed $input): bool
    {
        $this->isValid = in_array($input, $this->validOptions, strict: true);

        return $this->isValid;
    }

    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid option' : null;
    }
}
