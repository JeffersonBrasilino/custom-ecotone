<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\OptionalStringValidator;
use Tests\TestCase;

class OptionalStringValidatorTest extends TestCase
{
    public function testShouldValidateString()
    {
        $validator = new OptionalStringValidator();
        $this->assertTrue($validator->validate('string'));
    }

    public function testShouldValidateStringIsNull()
    {
        $validator = new OptionalStringValidator();
        $this->assertTrue($validator->validate(null));
    }

    public function testShouldNotValidateString()
    {
        $validator = new OptionalStringValidator();
        $this->assertFalse($validator->validate(10));
        $this->assertEquals('Invalid string', $validator->getErrorMessage());
    }
}
