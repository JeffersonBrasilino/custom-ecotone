<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\OptionalFloatValidator;
use Tests\TestCase;

class OptionalFloatValidatorTest extends TestCase
{
    public function testShouldValidateFloat()
    {
        $validator = new OptionalFloatValidator();
        $this->assertTrue($validator->validate(2.5));
    }

    public function testShouldValidateFloatIsNull()
    {
        $validator = new OptionalFloatValidator();
        $this->assertTrue($validator->validate(null));
    }

    public function testShouldNotValidateFloat()
    {
        $validator = new OptionalFloatValidator();
        $this->assertFalse($validator->validate(10));
        $this->assertEquals('Invalid float number', $validator->getErrorMessage());
    }
}
