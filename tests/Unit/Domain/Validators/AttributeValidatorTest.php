<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\{AttributeValidator, Validator};
use Tests\TestCase;

class AttributeValidatorTest extends TestCase
{
    public function testConstructor(): void
    {
        $validator = $this->createStub(Validator::class);
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $this->assertInstanceOf(AttributeValidator::class, $attributeValidator);
    }

    public function testGetAttribute(): void
    {
        $validator = $this->createStub(Validator::class);
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $this->assertEquals('attribute', $attributeValidator->attribute);
    }

    public function testSetValidator(): void
    {
        $validator = $this->createStub(Validator::class);
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $attributeValidator->setValidator($validator);
        $this->assertInstanceOf(Validator::class, $attributeValidator->getValidator());
    }

    public function testGetValidator(): void
    {
        $validator = $this->createStub(Validator::class);
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $this->assertInstanceOf(Validator::class, $attributeValidator->getValidator());
    }

    public function testValidate(): void
    {
        $validator = $this->createStub(Validator::class);
        $validator->method('validate')->willReturn(true);
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $this->assertTrue($attributeValidator->validate('input'));
    }

    public function testValidateWithError(): void
    {
        $validator = $this->createStub(Validator::class);
        $validator->method('validate')->willReturn(false);
        $validator->method('getErrorMessage')->willReturn('error');
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $this->assertFalse($attributeValidator->validate('input'));
        $this->assertEquals(['attribute' => 'error'], $attributeValidator->getErrorMessage());
    }

    public function testValidateArray(): void
    {
        $validator = $this->createStub(Validator::class);
        $validator->method('validate')->willReturn(true);
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $this->assertTrue($attributeValidator->validate(['attribute' => 'input']));
    }

    public function testValidateArrayWithErrors(): void
    {
        $validator = $this->createStub(Validator::class);
        $validator->method('validate')->willReturn(false);
        $validator->method('getErrorMessage')->willReturn('error');
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $this->assertFalse($attributeValidator->validate(['attribute' => 'input']));
        $this->assertEquals(['attribute' => 'error'], $attributeValidator->getErrorMessage());
    }

    public function testValidateObject(): void
    {
        $validator = $this->createStub(Validator::class);
        $validator->method('validate')->willReturn(true);
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $this->assertTrue($attributeValidator->validate((object) ['attribute' => 'input']));
    }

    public function testValidateObjectWithErrors(): void
    {
        $validator = $this->createStub(Validator::class);
        $validator->method('validate')->willReturn(false);
        $validator->method('getErrorMessage')->willReturn('error');
        $attributeValidator = new AttributeValidator('attribute', $validator);
        $this->assertFalse($attributeValidator->validate((object) ['attribute' => 'input']));
        $this->assertEquals(['attribute' => 'error'], $attributeValidator->getErrorMessage());
    }
}
