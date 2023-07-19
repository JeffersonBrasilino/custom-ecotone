<?php

declare(strict_types=1);

namespace Frete\Core\Shared;

class Result
{
    protected function __construct(protected bool $isSuccess, protected $value, protected $error)
    {
    }

    public static function success($value): Result
    {
        return new self(true, $value, null);
    }

    public static function failure($error): Result
    {
        return new self(false, null, $error);
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function isFailure(): bool
    {
        return !$this->isSuccess;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getError()
    {
        return $this->error;
    }

    public function map(callable $function): Result
    {
        if ($this->isSuccess) {
            try {
                return self::success($function($this->value));
            } catch (\Exception $e) {
                return self::failure($e);
            }
        }

        return $this;
    }

    public function flatMap(callable $function): Result
    {
        if ($this->isSuccess) {
            try {
                return $function($this->value);
            } catch (\Exception $e) {
                return self::failure($e);
            }
        }

        return $this;
    }

    public function onError(callable $function): Result
    {
        if (!$this->isSuccess) {
            $function($this->error);
        }

        return $this;
    }
}
