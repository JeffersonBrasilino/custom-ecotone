<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

interface EventFactory
{
    public function createEvent(string $eventName, array $data): Event;
}
