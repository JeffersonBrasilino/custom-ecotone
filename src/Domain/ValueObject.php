<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

interface ValueObject
{
    public function equals(ValueObject $valueObject): bool;
}
