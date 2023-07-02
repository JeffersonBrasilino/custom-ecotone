<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use Frete\Core\Domain\Money;
use Tests\TestCase;

class MoneyTest extends TestCase
{
    public function testGetAmount()
    {
        $money = new Money(10.0);
        $this->assertEquals(10.0, $money->getAmount());
    }

    public function testSetAmount()
    {
        $money = new Money(10.0);
        $money->setAmount(20.0);
        $this->assertEquals(20.0, $money->getAmount());
    }
}
