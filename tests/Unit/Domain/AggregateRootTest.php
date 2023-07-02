<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use DateTimeImmutable;
use Frete\Core\Domain\{AggregateRoot, Event};
use Tests\TestCase;

class AggregateRootTest extends TestCase
{
    public function testShouldAddEvent(): void
    {
        $aggregateRoot = new DummyAggregateRoot('1');
        $aggregateRoot->doSomething(['foo' => 'bar']);
        $events = array_values($aggregateRoot->getEvents());
        $this->assertCount(1, $events);
        $this->assertInstanceOf(DummyDomainEvent::class, $events[0]);
    }

    public function testShouldCommitEvent(): void
    {
        $aggregateRoot = new DummyAggregateRoot('1');
        $aggregateRoot->doSomething(['foo' => 'bar']);
        $events = array_values($aggregateRoot->getEvents());
        $this->assertCount(1, $events);
        $this->assertInstanceOf(DummyDomainEvent::class, $events[0]);
        $aggregateRoot->commitEvent($events[0]);
        $this->assertCount(0, $aggregateRoot->getEvents());
    }
}

class DummyDomainEvent extends Event
{
    public function __construct(
        string|int $identifier,
        ?array $data = [],
        ?string $schema = 'https://schema.org/',
        ?string $version = '1.0',
        ?DateTimeImmutable $occurredOn = new DateTimeImmutable()
    ) {
        parent::__construct($identifier, $data, $schema, $version, $occurredOn);
    }
}

class DummyAggregateRoot extends AggregateRoot
{
    public function __construct(
        string $id,
        public readonly string $name = 'foo',
        public readonly string $surname = 'bar'
    ) {
        parent::__construct($id);
    }

    public function doSomething($data): void
    {
        $this->addEvent(new DummyDomainEvent($this->id, $data));
    }
}
