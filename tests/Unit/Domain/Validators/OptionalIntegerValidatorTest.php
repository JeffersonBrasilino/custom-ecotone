<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\OptionalIntegerValidator;
use Tests\TestCase;

class OptionalIntegerValidatorTest extends TestCase
{
    public function testShouldValidateInteger()
    {
        $validator = new OptionalIntegerValidator();
        $this->assertTrue($validator->validate(10));
    }

    public function testShouldValidateIntegerIsNull()
    {
        $validator = new OptionalIntegerValidator();
        $this->assertTrue($validator->validate(null));
    }

    public function testShouldNotValidateInteger()
    {
        $validator = new OptionalIntegerValidator();
        $this->assertFalse($validator->validate(2.5));
        $this->assertEquals('Invalid integer number', $validator->getErrorMessage());
    }
}
