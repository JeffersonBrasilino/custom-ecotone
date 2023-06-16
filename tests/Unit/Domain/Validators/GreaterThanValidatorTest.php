<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\GreaterThanValidator;
use Tests\TestCase;

class GreaterThanValidatorTest extends TestCase
{
    public function testValidateReturnsTrueForValidInput()
    {
        $validator = new GreaterThanValidator(0);
        $this->assertTrue($validator->validate(10));
        $this->assertTrue($validator->validate(3.14));
        $this->assertTrue($validator->validate(PHP_INT_MAX));
    }

    public function testValidateReturnsFalseForInvalidInput()
    {
        $validator = new GreaterThanValidator(0);
        $this->assertFalse($validator->validate(-10));
        $this->assertFalse($validator->validate(0));
        $this->assertFalse($validator->validate('not a number'));
    }

    public function testGetErrorMessageReturnsString()
    {
        $validator = new GreaterThanValidator(0);
        $this->assertIsString($validator->getErrorMessage());
    }

    public function testGetErrorMessageReturnsCorrectString()
    {
        $min = -5;
        $validator = new GreaterThanValidator($min);
        $this->assertEquals("Value must be numeric and greater than {$min}", $validator->getErrorMessage());
    }
}
