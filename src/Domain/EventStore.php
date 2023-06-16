<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

interface EventStore
{
    public function addEvent(Event $message): void;

    public function getEvents(): array;

    public function commitEvent(Event $message): void;
}
