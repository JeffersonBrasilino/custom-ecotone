<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\NotEmptyValidator;
use Tests\TestCase;

class NotEmptyValidatorTest extends TestCase
{
    public function testShouldValidateEmptyString()
    {
        $validator = new NotEmptyValidator();
        $this->assertFalse($validator->validate(''));
        $this->assertEquals('Cannot be empty', $validator->getErrorMessage());
    }

    public function testShouldValidateEmptyArray()
    {
        $validator = new NotEmptyValidator();
        $this->assertFalse($validator->validate([]));
        $this->assertEquals('Cannot be empty', $validator->getErrorMessage());
    }

    public function testShouldValidateNull()
    {
        $validator = new NotEmptyValidator();
        $this->assertFalse($validator->validate(null));
        $this->assertEquals('Cannot be empty', $validator->getErrorMessage());
    }

    public function testShouldValidateFalse()
    {
        $validator = new NotEmptyValidator();
        $this->assertFalse($validator->validate(false));
        $this->assertEquals('Cannot be empty', $validator->getErrorMessage());
    }

    public function testShouldValidateZero()
    {
        $validator = new NotEmptyValidator();
        $this->assertFalse($validator->validate(0));
        $this->assertEquals('Cannot be empty', $validator->getErrorMessage());
    }

    public function testShouldValidateNotEmptyString()
    {
        $validator = new NotEmptyValidator();
        $this->assertTrue($validator->validate('test'));
    }

    public function testShouldValidateNotEmptyArray()
    {
        $validator = new NotEmptyValidator();
        $this->assertTrue($validator->validate(['test']));
    }

    public function testShouldValidateTrue()
    {
        $validator = new NotEmptyValidator();
        $this->assertTrue($validator->validate(true));
    }

    public function testShouldValidateInteger()
    {
        $validator = new NotEmptyValidator();
        $this->assertTrue($validator->validate(1));
    }

    public function testShouldValidateFloat()
    {
        $validator = new NotEmptyValidator();
        $this->assertTrue($validator->validate(1.1));
    }
}
