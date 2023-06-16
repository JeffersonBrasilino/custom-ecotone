<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

use DateTime;
use Exception;

class DateValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        $this->isValid = $this->isString($input) && $this->isAValidDate($input);
        return $this->isValid;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage(): string|null
    {
        return !$this->isValid ? 'Invalid date format' : null;
    }

    private function isString(mixed $input): bool
    {
        return is_string($input);
    }

    private function isAValidDate($date)
    {
        try {
            $date = new DateTime($date);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
