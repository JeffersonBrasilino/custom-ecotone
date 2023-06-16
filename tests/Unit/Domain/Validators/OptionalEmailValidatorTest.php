<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\OptionalEmailValidator;
use Tests\TestCase;

class OptionalEmailValidatorTest extends TestCase
{
    public function testShouldValidateEmail()
    {
        $validator = new OptionalEmailValidator();
        $this->assertTrue($validator->validate('dummy@email.com.br'));
    }

    public function testShouldValidateEmailIsNull()
    {
        $validator = new OptionalEmailValidator();
        $this->assertTrue($validator->validate(null));
    }

    public function testShouldNotValidateEmail()
    {
        $validator = new OptionalEmailValidator();
        $this->assertFalse($validator->validate('dummyemail.com.br'));
        $this->assertEquals('Invalid email address', $validator->getErrorMessage());
    }
}
