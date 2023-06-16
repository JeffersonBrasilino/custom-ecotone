<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\PositiveNumberValidator;
use Tests\TestCase;

class PositiveNumberValidatorTest extends TestCase
{
    public function testShouldValidatePositive()
    {
        $validator = new PositiveNumberValidator();
        $this->assertTrue($validator->validate(10));
    }

    public function testShouldNotValidatePositive()
    {
        $validator = new PositiveNumberValidator();
        $this->assertFalse($validator->validate(-10));
        $this->assertEquals('Not a positive number', $validator->getErrorMessage());
    }
}
