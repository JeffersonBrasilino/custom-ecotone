<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

abstract class AggregateRoot extends Entity implements EventFactory, EventStore
{
    private \ArrayObject $eventsToCommit;
    private \ArrayObject $eventsCommited;

    public function __construct(string $id)
    {
        parent::__construct($id);
        $this->eventsToCommit = new \ArrayObject();
        $this->eventsCommited = new \ArrayObject();
    }

    public function addEvent(Event $event): void
    {
        $this->eventsToCommit->offsetSet($this->generateKeyOffset($event), $event);
    }

    public function getEvents(): array
    {
        return $this->eventsToCommit->getArrayCopy();
    }

    private function generateKeyOffset(Event $event): string
    {
        return md5(serialize($event));
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

    public function createEvent(string $eventName, array $data): Event
    {
        $event = new $eventName($this->id, $data);
        $this->addEvent($event);

        return $event;
    }
}
