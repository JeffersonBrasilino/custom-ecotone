<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Validators;

class CpfValidator extends Validator
{
    private bool $isValid = false;

    public function validate(mixed $input): bool
    {
        if (null === $input) {
            return false;
        }

        $this->isValid = $this->isCpfValid($input);

        return $this->isValid;
    }

    public function getErrorMessage(): ?string
    {
        return !$this->isValid ? 'Invalid cpf' : null;
    }

    private function isCpfValid(string $input): bool
    {
        if (preg_match('/[a-zA-Z]/', $input)) {
            return false;
        }

        $c = preg_replace('/\D/', '', $input);

        if (11 != mb_strlen($c) || preg_match('/^' . $c[0] . '{11}$/', $c) || '01234567890' === $c) {
            return false;
        }

        $n = 0;
        for ($s = 10, $i = 0; $s >= 2; ++$i, --$s) {
            $n += intval($c[$i]) * $s;
        }

        if ($c[9] != (($n %= 11) < 2 ? 0 : 11 - $n)) {
            return false;
        }

        $n = 0;
        for ($s = 11, $i = 0; $s >= 2; ++$i, --$s) {
            $n += intval($c[$i]) * $s;
        }

        $check = ($n %= 11) < 2 ? 0 : 11 - $n;

        return $c[10] == $check;
    }
}
