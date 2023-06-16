<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\LessThanValidator;
use Tests\TestCase;

class LessThanValidatorTest extends TestCase
{
    public function testLessThanValidatorReturnsTrueOnValidInput()
    {
        $max = 10;
        $input = 5;

        $validator = new LessThanValidator($max);

        $this->assertTrue($validator->validate($input));
    }

    public function testLessThanValidatorReturnsFalseOnInputEqualToMax()
    {
        $max = 10;
        $input = 10;

        $validator = new LessThanValidator($max);

        $this->assertFalse($validator->validate($input));
    }

    public function testLessThanValidatorReturnsFalseOnInvalidInput()
    {
        $max = 10;
        $input = 'invalid';

        $validator = new LessThanValidator($max);

        $this->assertFalse($validator->validate($input));
    }

    public function testLessThanValidatorReturnsCorrectErrorMessage()
    {
        $max = 10;
        $invalidInput = 'invalid';
        $validator = new LessThanValidator($max);

        $this->assertEquals('The value must be numeric and less than 10', $validator->getErrorMessage());
        $this->assertIsString($validator->getErrorMessage());

        $validator->validate($invalidInput);

        $this->assertEquals('The value must be numeric and less than 10', $validator->getErrorMessage());
    }
}
