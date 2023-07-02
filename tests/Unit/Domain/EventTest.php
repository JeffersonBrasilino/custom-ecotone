<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use DateTimeImmutable;
use Frete\Core\Domain\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testConstructorWithValidValues(): void
    {
        $identifier = 'foo';
        $data = ['bar' => 123];
        $schema = 'https://schema.org/';
        $version = '1.0';
        $occurredOn = new DateTimeImmutable('2022-01-01 12:00:00');

        $event = new class($identifier, $data, $schema, $version, $occurredOn) extends Event {
        };

        $this->assertSame($identifier, $event->identifier);
        $this->assertSame($data, $event->data);
        $this->assertSame($schema, $event->schema);
        $this->assertSame($version, $event->version);
        $this->assertSame($occurredOn, $event->occurredOn);
    }

    public function testConstructorWithDefaultValues(): void
    {
        $identifier = 'foo';

        $event = new class($identifier) extends Event {
        };

        $this->assertSame($identifier, $event->identifier);
        $this->assertSame([], $event->data);
        $this->assertSame('https://schema.org/', $event->schema);
        $this->assertSame('1.0', $event->version);
        $this->assertInstanceOf(DateTimeImmutable::class, $event->occurredOn);
    }
}
