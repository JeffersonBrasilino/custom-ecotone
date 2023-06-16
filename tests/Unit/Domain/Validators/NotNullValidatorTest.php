<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\NotNullValidator;
use Tests\TestCase;

class NotNullValidatorTest extends TestCase
{
    private NotNullValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new NotNullValidator();
    }

    public function testValidateReturnsTrueWhenInputIsNotNull(): void
    {
        $input = 'some value';
        $isValid = $this->validator->validate($input);

        $this->assertTrue($isValid);
    }

    public function testValidateReturnsFalseWhenInputIsNull(): void
    {
        $input = null;
        $isValid = $this->validator->validate($input);

        $this->assertFalse($isValid);
    }

    public function testGetErrorMessageReturnsString(): void
    {
        $errorMessage = $this->validator->getErrorMessage();

        $this->assertIsString($errorMessage);
    }

    public function testGetErrorMessageReturnsExpectedString(): void
    {
        $expectedErrorMessage = 'Cannot be null';
        $errorMessage = $this->validator->getErrorMessage();

        $this->assertEquals($expectedErrorMessage, $errorMessage);
    }
}
