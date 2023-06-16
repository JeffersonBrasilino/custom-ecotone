<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure;

use Frete\Core\Domain\IdGenerator;
use Ramsey\Uuid\Uuid;

class UuidGenerator implements IdGenerator
{
    public static function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
