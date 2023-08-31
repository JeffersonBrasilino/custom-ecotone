<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

/**
 * @template Tid of string|int
 */
interface Aggregate
{
    /**
     * @return Tid of string|int
     */
    public function getId(): string|int;
}
