<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class AttributeValidator extends Validator
{
    public function __construct(
        public readonly string $attribute,
        protected ?Validator $validator = null
    ) {
    }

    public function getValidator(): Validator
    {
        return $this->validator;
    }

    public function setValidator(Validator $validator): void
    {
        $this->validator = $validator;
    }

    public function getErrorMessage()
    {
        return [
            $this->attribute => $this->validator->getErrorMessage(),
        ];
    }

    public function validate(mixed $input): bool
    {
        if (is_object($input) && property_exists($input, $this->attribute)) {
            $this->validator->validate($input->{$this->attribute});
        }

        if (is_array($input) && array_key_exists($this->attribute, $input)) {
            $this->validator->validate($input[$this->attribute]);
        }

        return empty($this->validator->getErrorMessage());
    }
}
