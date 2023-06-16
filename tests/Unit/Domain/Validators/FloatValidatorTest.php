<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\FloatValidator;
use Tests\TestCase;

class FloatValidatorTest extends TestCase
{
    public function testShouldValidateFloat()
    {
        $validator = new FloatValidator();
        $this->assertTrue($validator->validate(2.5));
    }

    public function testShouldNotValidateFloat()
    {
        $validator = new FloatValidator();
        $this->assertFalse($validator->validate(10));
        $this->assertEquals('Invalid float number', $validator->getErrorMessage());
    }
}
