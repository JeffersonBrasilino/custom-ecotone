<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\IntegerValidator;
use Tests\TestCase;

class IntegerValidatorTest extends TestCase
{
    public function testShouldValidateInteger()
    {
        $validator = new IntegerValidator();
        $this->assertTrue($validator->validate(10));
    }

    public function testShouldNotValidateInteger()
    {
        $validator = new IntegerValidator();
        $this->assertFalse($validator->validate(2.5));
        $this->assertEquals('Invalid integer number', $validator->getErrorMessage());
    }
}
