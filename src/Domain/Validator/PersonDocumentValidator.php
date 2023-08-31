<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validator;

class PersonDocumentValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        return (new CpfValidator())->validate($input) || (new CnpjValidator())->validate($input);
    }

    public function getErrorMessage(): string|array|null
    {
        return !$this->isValid ? 'Invalid document' : null;
    }
}
