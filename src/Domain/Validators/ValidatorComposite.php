<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class ValidatorComposite extends Validator
{
    public function __construct(
        protected \ArrayObject $validators = new \ArrayObject(),
        protected \ArrayObject $errorMessage = new \ArrayObject()
    ) {
    }

    public function addValidator(Validator $validator): void
    {
        $this->validators->append($validator);
    }

    public function getValidators(): \ArrayObject
    {
        return $this->validators;
    }

    public function getErrorMessage(): array
    {
        return $this->errorMessage->getArrayCopy();
    }

    public function validate(mixed $input): bool
    {
        $this->errorMessage->exchangeArray([]);

        foreach ($this->validators as $validator) {
            if ($validator->validate($input)) {
                continue;
            }
            $errorMessage = $validator->getErrorMessage();
            if (is_array($errorMessage)) {
                $this->errorMessage->exchangeArray(array_merge($this->errorMessage->getArrayCopy(), $errorMessage));

                continue;
            }
            $this->errorMessage->append($errorMessage);
        }

        return 0 === $this->errorMessage->count();
    }
}
