<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\EmailValidator;
use Tests\TestCase;

class EmailValidatorTest extends TestCase
{
    public function testShouldValidateEmail()
    {
        $validator = new EmailValidator();
        $this->assertTrue($validator->validate('dummy@email.com.br'));
    }

    public function testShouldNotValidateEmail()
    {
        $validator = new EmailValidator();
        $this->assertFalse($validator->validate('dummyemail.com.br'));
        $this->assertEquals('Invalid email address', $validator->getErrorMessage());
    }
}
