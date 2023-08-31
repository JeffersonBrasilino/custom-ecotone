<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

class BaseAggregateBuilder implements AggregateBuilder
{
    private ?string $id;

    public function __construct(
        private string $aggregateClass
    ) {
    }

    public function withId(string $id): AggregateBuilder
    {
        $this->id = $id;

        return $this;
    }

    public function build(): Aggregate
    {
        $aggregate = new $this->aggregateClass($this->id);

        $this->id = null;

        return $aggregate;
    }
}
