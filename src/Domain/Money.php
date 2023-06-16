<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

class Money
{
    public function __construct(private float $amount)
    {
    }

    /**
     * Get the value of amount.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set the value of amount.
     *
     * @param float $amount
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
