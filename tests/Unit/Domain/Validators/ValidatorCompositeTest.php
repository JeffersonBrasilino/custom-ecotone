<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\ValidatorCollectionDecorator;
use Frete\Core\Domain\Validators\{Validator, ValidatorComposite};
use Tests\TestCase;

class ValidatorCompositeTest extends TestCase
{
    public function testAddValidator()
    {
        $validatorComposite = new ValidatorComposite();
        $validator1 = $this->createStub(Validator::class);
        $validator2 = $this->createStub(Validator::class);
        $validatorComposite->addValidator($validator1);
        $validatorComposite->addValidator($validator2);

        $this->assertCount(2, $validatorComposite->getValidators());
    }

    public function testValidateSingleValue()
    {
        $validatorComposite = new ValidatorComposite();

        $validatorComposite = new ValidatorComposite();
        $validator1 = $this->createStub(Validator::class);
        $validator1->method('validate')->willReturn(true);
        $validator2 = $this->createStub(Validator::class);
        $validator2->method('validate')->willReturn(true);
        $validatorComposite->addValidator($validator1);
        $validatorComposite->addValidator($validator2);

        $isValid = $validatorComposite->validate('some-value');
        $this->assertTrue($isValid);
    }

    public function testValidateMultipleValues()
    {
        $validator = $this->createStub(Validator::class);
        $validator->expects($this->exactly(3))->method('validate')->willReturn(false);
        $validator->expects($this->exactly(3))->method('getErrorMessage')->willReturn('error');

        $input = ['some-value-1', 'some-value-2', 'some-value-3'];
        $expected = [
            'isValid' => false,
            'errorMessage' => [
                0 => 'error',
                1 => 'error',
                2 => 'error',
            ]
        ];

        $validatorCollectionDecorator = new ValidatorCollectionDecorator($validator);
        $validatorComposite = new ValidatorComposite();
        $validatorComposite->addValidator($validatorCollectionDecorator);

        $actual = [
            'isValid' => $validatorComposite->validate($input),
            'errorMessage' => $validatorComposite->getErrorMessage()
        ];

        $this->assertEquals($expected, $actual);
    }
}
