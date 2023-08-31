<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validator;

class CnpjValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        if (null === $input) {
            return false;
        }

        $this->isValid = $this->isCnpjValid($input);

        return $this->isValid;
    }

    public function getErrorMessage(): ?string
    {
        return !$this->isValid ? 'Invalid cnpj' : null;
    }

    private function isCnpjValid(string $input): bool
    {
        if (preg_match('/[a-zA-Z]/', $input)) {
            return false;
        }

        $bases = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $digits = $this->getDigits((string) $input);

        if (array_sum($digits) < 1) {
            return false;
        }

        if (14 !== count($digits)) {
            return false;
        }

        $n = 0;
        for ($i = 0; $i < 12; ++$i) {
            $n += $digits[$i] * $bases[$i + 1];
        }

        if ($digits[12] != (($n %= 11) < 2 ? 0 : 11 - $n)) {
            return false;
        }

        $n = 0;
        for ($i = 0; $i <= 12; ++$i) {
            $n += $digits[$i] * $bases[$i];
        }

        $check = ($n %= 11) < 2 ? 0 : 11 - $n;

        return $digits[13] == $check;
    }

    private function getDigits(string $input): array
    {
        return array_map(
            'intval',
            str_split(
                (string) preg_replace('/\D/', '', $input)
            )
        );
    }
}
