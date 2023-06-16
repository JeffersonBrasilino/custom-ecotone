<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\BooleanValidator;
use Tests\TestCase;

class BooleanValidatorTest extends TestCase
{
    public function testShouldValidateBoolean()
    {
        $validator = new BooleanValidator();
        $this->assertTrue($validator->validate(true));
    }

    public function testShouldNotValidateBoolean()
    {
        $validator = new BooleanValidator();
        $this->assertFalse($validator->validate('true'));
        $this->assertEquals('Invalid boolean', $validator->getErrorMessage());
    }
}
