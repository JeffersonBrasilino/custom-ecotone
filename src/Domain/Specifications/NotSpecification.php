<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Specifications;

class NotSpecification extends AbstractSpecification
{
    private Specification $specification;

    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(mixed $target): bool
    {
        return !$this->specification->isSatisfiedBy($target);
    }
}
