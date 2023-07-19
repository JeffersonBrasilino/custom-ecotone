<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Errors;

use Frete\Core\Domain\Event;

class EventConsumerError extends Event
{
    public function __construct(string|int $id, $data = [])
    {
        parent::__construct($id, $data);
    }
}
