<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

interface AggregateBuilder
{
    public function withId(string $id): AggregateBuilder;

    /**
     * @template T of Aggregate
     *
     * @return T
     */
    public function build(): Aggregate;
}
