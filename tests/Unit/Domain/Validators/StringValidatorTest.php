<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\StringValidator;
use Tests\TestCase;

class StringValidatorTest extends TestCase
{
    public function testShouldValidateString()
    {
        $validator = new StringValidator();
        $this->assertTrue($validator->validate('string'));
    }

    public function testShouldNotValidateString()
    {
        $validator = new StringValidator();
        $this->assertFalse($validator->validate(10));
        $this->assertEquals('Invalid string', $validator->getErrorMessage());
    }
}
