<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

use ArrayObject;

abstract class AggregateRoot extends Entity implements EventStore
{
    private ArrayObject $eventsToCommit;
    private ArrayObject $eventsCommited;

    public function __construct(string $id)
    {
        parent::__construct($id);
        $this->eventsToCommit = new ArrayObject();
        $this->eventsCommited = new ArrayObject();
    }

    public function addEvent(Event $event): void
    {
        $this->eventsToCommit->offsetSet($this->generateKeyOffset($event), $event);
    }

    public function getEvents(): array
    {
        return $this->eventsToCommit->getArrayCopy();
    }

    public function commitEvent(Event $event): void
    {
        $key = $this->generateKeyOffset($event);
        $event = $this->eventsToCommit->offsetGet($key);
        if ($event) {
            $this->eventsCommited->offsetSet($key, $event);
            $this->eventsToCommit->offsetUnset($key);
        }
    }

    private function generateKeyOffset(Event $event): string
    {
        return md5(serialize($event));
    }
}
