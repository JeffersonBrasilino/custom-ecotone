<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Specifications;

use Frete\Core\Domain\Specifications\{AndSpecification, Specification};
use Tests\TestCase;

class AndSpecificationTest extends TestCase
{
    public function testIsSatisfiedBy(): void
    {
        $spec1 = $this->createMock(Specification::class);
        $spec1->method('isSatisfiedBy')->willReturn(true);
        $spec2 = $this->createMock(Specification::class);
        $spec2->method('isSatisfiedBy')->willReturn(true);
        $spec = new AndSpecification($spec1, $spec2);
        $this->assertTrue($spec->isSatisfiedBy('foo'));
    }

    public function testIsNotSatisfiedByLeft(): void
    {
        $spec1 = $this->createMock(Specification::class);
        $spec1->method('isSatisfiedBy')->willReturn(false);
        $spec2 = $this->createMock(Specification::class);
        $spec2->method('isSatisfiedBy')->willReturn(true);
        $spec = new AndSpecification($spec1, $spec2);
        $this->assertFalse($spec->isSatisfiedBy('foo'));
    }

    public function testIsNotSatisfiedByRight(): void
    {
        $spec1 = $this->createMock(Specification::class);
        $spec1->method('isSatisfiedBy')->willReturn(true);
        $spec2 = $this->createMock(Specification::class);
        $spec2->method('isSatisfiedBy')->willReturn(false);
        $spec = new AndSpecification($spec1, $spec2);
        $this->assertFalse($spec->isSatisfiedBy('foo'));
    }

    public function testIsNotSatisfiedByBoth(): void
    {
        $spec1 = $this->createMock(Specification::class);
        $spec1->method('isSatisfiedBy')->willReturn(false);
        $spec2 = $this->createMock(Specification::class);
        $spec2->method('isSatisfiedBy')->willReturn(false);
        $spec = new AndSpecification($spec1, $spec2);
        $this->assertFalse($spec->isSatisfiedBy('foo'));
    }
}
