<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\OptionalPositiveNumberValidator;
use Tests\TestCase;

class OptionalPositiveNumberValidatorTest extends TestCase
{
    public function testShouldValidatePositive()
    {
        $validator = new OptionalPositiveNumberValidator();
        $this->assertTrue($validator->validate(10));
    }

    public function testShouldValidatePositiveIsNull()
    {
        $validator = new OptionalPositiveNumberValidator();
        $this->assertTrue($validator->validate(null));
    }

    public function testShouldNotValidatePositive()
    {
        $validator = new OptionalPositiveNumberValidator();
        $this->assertFalse($validator->validate(-10));
        $this->assertEquals('Not a positive number', $validator->getErrorMessage());
    }
}
