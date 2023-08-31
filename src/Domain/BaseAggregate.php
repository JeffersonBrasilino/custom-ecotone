<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

/**
 * Aggregate class.
 *
 * @implements Aggregate<string>
 */
class BaseAggregate implements Aggregate
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
