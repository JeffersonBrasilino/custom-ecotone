<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Specifications;

use Frete\Core\Domain\Specifications\NotSpecification;
use Frete\Core\Domain\Specifications\{
    AbstractSpecification,
    AndSpecification,
    OrSpecification
};
use stdClass;
use Tests\TestCase;

class AbstractSpecificationTest extends TestCase
{
    public function testAndSpecification(): void
    {
        $spec1 = new class() extends AbstractSpecification {
            public function isSatisfiedBy($object): bool
            {
                return true;
            }
        };

        $spec2 = new class() extends AbstractSpecification {
            public function isSatisfiedBy($object): bool
            {
                return true;
            }
        };

        $spec3 = $spec1->and($spec2);

        $this->assertInstanceOf(AndSpecification::class, $spec3);
        $this->assertTrue($spec3->isSatisfiedBy(new stdClass()));
    }

    public function testOrSpecification(): void
    {
        $spec1 = new class() extends AbstractSpecification {
            public function isSatisfiedBy($object): bool
            {
                return true;
            }
        };

        $spec2 = new class() extends AbstractSpecification {
            public function isSatisfiedBy($object): bool
            {
                return false;
            }
        };

        $spec3 = $spec1->or($spec2);

        $this->assertInstanceOf(OrSpecification::class, $spec3);
        $this->assertTrue($spec3->isSatisfiedBy(new stdClass()));
    }

    public function testNotSpecification(): void
    {
        $spec1 = new class() extends AbstractSpecification {
            public function isSatisfiedBy($object): bool
            {
                return true;
            }
        };

        $spec2 = $spec1->not();

        $this->assertInstanceOf(NotSpecification::class, $spec2);
        $this->assertFalse($spec2->isSatisfiedBy(new stdClass()));
    }
}
