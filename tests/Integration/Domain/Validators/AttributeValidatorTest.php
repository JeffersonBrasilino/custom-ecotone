<?php

declare(strict_types=1);

namespace Tests\Integration\Domain\Validators;

use ArrayObject;
use Frete\Core\Domain\Validators\{AttributeValidator, FloatValidator, NotNullValidator, OneOfOptionsValidator, StringValidator};
use Frete\Core\Domain\Validators\{ValidatorCollectionDecorator, ValidatorComposite};
use stdClass;
use Tests\TestCase;

final class AttributeValidatorTest extends TestCase
{
    private AttributeValidator $sut;

    public function testValidateSingleWhenArray(): void
    {
        $input = [
            'attributeRoot' => [
                'attributeOne' => 'string',
                'attributeTwo' => 1.1,
                'attributeThree' => 'option1',
            ]
        ];

        $expected = [
            'isValid' => true,
            'errorMessage' => [
                'attributeRoot' => []
            ]
        ];

        $notNullValidator = new NotNullValidator();
        $stringValidator = new StringValidator();
        $floatValidator = new FloatValidator();
        $oneOfOptionsValidator = new OneOfOptionsValidator(['option1', 'option2']);

        $notNullStringCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $stringValidator]));
        $notNullFloatCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $floatValidator]));
        $notNullOneOfOptionsCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $oneOfOptionsValidator]));

        $attributeOneValidator = new AttributeValidator('attributeOne', $notNullStringCompositeValidator);
        $attributeTwoValidator = new AttributeValidator('attributeTwo', $notNullFloatCompositeValidator);
        $attributeThreeValidator = new AttributeValidator('attributeThree', $notNullOneOfOptionsCompositeValidator);

        $attributeRootValidator = new ValidatorComposite(new ArrayObject([
            $attributeOneValidator,
            $attributeTwoValidator,
            $attributeThreeValidator
        ]));

        $this->sut = new AttributeValidator('attributeRoot', $attributeRootValidator);

        $actual = [
            'isValid' => $this->sut->validate($input),
            'errorMessage' => $this->sut->getErrorMessage()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testValidateSingleWhenObject(): void
    {
        $input = new stdClass();
        $input->attributeRoot = new stdClass();
        $input->attributeRoot->attributeOne = 'string';
        $input->attributeRoot->attributeTwo = 1.1;
        $input->attributeRoot->attributeThree = 'option1';

        $expected = [
            'isValid' => true,
            'errorMessage' => [
                'attributeRoot' => []
            ]
        ];

        $notNullValidator = new NotNullValidator();
        $stringValidator = new StringValidator();
        $floatValidator = new FloatValidator();
        $oneOfOptionsValidator = new OneOfOptionsValidator(['option1', 'option2']);

        $notNullStringCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $stringValidator]));
        $notNullFloatCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $floatValidator]));
        $notNullOneOfOptionsCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $oneOfOptionsValidator]));

        $attributeOneValidator = new AttributeValidator('attributeOne', $notNullStringCompositeValidator);
        $attributeTwoValidator = new AttributeValidator('attributeTwo', $notNullFloatCompositeValidator);
        $attributeThreeValidator = new AttributeValidator('attributeThree', $notNullOneOfOptionsCompositeValidator);

        $attributeRootValidator = new ValidatorComposite(new ArrayObject([
            $attributeOneValidator,
            $attributeTwoValidator,
            $attributeThreeValidator
        ]));

        $this->sut = new AttributeValidator('attributeRoot', $attributeRootValidator);

        $actual = [
            'isValid' => $this->sut->validate($input),
            'errorMessage' => $this->sut->getErrorMessage()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testValidateCollectionWhenArray(): void
    {
        $input = [
            'attributeRoot' => [
                [
                    'attributeOne' => null,
                    'attributeTwo' => 1.1,
                    'attributeThree' => 'option1',
                ],
                [
                    'attributeOne' => 'string',
                    'attributeTwo' => 1.1,
                    'attributeThree' => 'option1',
                ]
            ]
        ];

        $expected = [
            'isValid' => false,
            'errorMessage' => [
                'attributeRoot' => [
                    0 => [
                        'attributeOne' => [
                            0 => 'Cannot be null',
                            1 => 'Invalid string'
                        ]
                    ]
                ]
            ]
        ];

        $notNullValidator = new NotNullValidator();
        $stringValidator = new StringValidator();
        $floatValidator = new FloatValidator();
        $oneOfOptionsValidator = new OneOfOptionsValidator(['option1', 'option2']);

        $notNullStringCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $stringValidator]));
        $notNullFloatCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $floatValidator]));
        $notNullOneOfOptionsCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $oneOfOptionsValidator]));

        $attributeOneValidator = new AttributeValidator('attributeOne', $notNullStringCompositeValidator);
        $attributeTwoValidator = new AttributeValidator('attributeTwo', $notNullFloatCompositeValidator);
        $attributeThreeValidator = new AttributeValidator('attributeThree', $notNullOneOfOptionsCompositeValidator);

        $attributeRootValidator = new ValidatorComposite(new ArrayObject([
            $attributeOneValidator,
            $attributeTwoValidator,
            $attributeThreeValidator
        ]));

        $attributeRootValidatorCollection = new ValidatorCollectionDecorator($attributeRootValidator);

        $this->sut = new AttributeValidator('attributeRoot', $attributeRootValidatorCollection);

        $actual = [
            'isValid' => $this->sut->validate($input),
            'errorMessage' => $this->sut->getErrorMessage()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testValidateCollectionWhenObject(): void
    {
        $firstClass = new stdClass();
        $firstClass->attributeOne = null;
        $firstClass->attributeTwo = 1.1;
        $firstClass->attributeThree = 'option1';

        $secondClass = new stdClass();
        $secondClass->attributeOne = null;
        $secondClass->attributeTwo = 1.1;
        $secondClass->attributeThree = 'option1';

        $input = new stdClass();
        $input->attributeRoot = [$firstClass, $secondClass];

        $expected = [
            'isValid' => false,
            'errorMessage' => [
                'attributeRoot' => [
                    0 => [
                        'attributeOne' => [
                            0 => 'Cannot be null',
                            1 => 'Invalid string'
                        ]
                    ],
                    1 => [
                        'attributeOne' => [
                            0 => 'Cannot be null',
                            1 => 'Invalid string'
                        ]
                    ]
                ]
            ]
        ];

        $notNullValidator = new NotNullValidator();
        $stringValidator = new StringValidator();
        $floatValidator = new FloatValidator();
        $oneOfOptionsValidator = new OneOfOptionsValidator(['option1', 'option2']);

        $notNullStringCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $stringValidator]));
        $notNullFloatCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $floatValidator]));
        $notNullOneOfOptionsCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $oneOfOptionsValidator]));

        $attributeOneValidator = new AttributeValidator('attributeOne', $notNullStringCompositeValidator);
        $attributeTwoValidator = new AttributeValidator('attributeTwo', $notNullFloatCompositeValidator);
        $attributeThreeValidator = new AttributeValidator('attributeThree', $notNullOneOfOptionsCompositeValidator);

        $attributeRootValidator = new ValidatorComposite(new ArrayObject([
            $attributeOneValidator,
            $attributeTwoValidator,
            $attributeThreeValidator
        ]));

        $attributeRootValidatorCollection = new ValidatorCollectionDecorator($attributeRootValidator);

        $this->sut = new AttributeValidator('attributeRoot', $attributeRootValidatorCollection);

        $actual = [
            'isValid' => $this->sut->validate($input),
            'errorMessage' => $this->sut->getErrorMessage()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testValidateCollectionNestedWhenArray(): void
    {
        $input = [
            'attributeRoot' => [
                [
                    'attributeOne' => [null, null],
                    'attributeTwo' => [1.1, 1.1],
                    'attributeThree' => ['option1', 'option1'],
                ],
                [
                    'attributeOne' => [null, null],
                    'attributeTwo' => [1.1, 1.1],
                    'attributeThree' => ['option1', 'option1'],
                ]
            ]
        ];

        $expected = [
            'isValid' => false,
            'errorMessage' => [
                'attributeRoot' => [
                    0 => [
                        'attributeOne' => [
                            0 => [
                                0 => 'Cannot be null',
                                1 => 'Invalid string'
                            ],
                            1 => [
                                0 => 'Cannot be null',
                                1 => 'Invalid string'
                            ]
                        ]
                    ],
                    1 => [
                        'attributeOne' => [
                            0 => [
                                0 => 'Cannot be null',
                                1 => 'Invalid string'
                            ],
                            1 => [
                                0 => 'Cannot be null',
                                1 => 'Invalid string'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $notNullValidator = new NotNullValidator();
        $stringValidator = new StringValidator();
        $floatValidator = new FloatValidator();
        $oneOfOptionsValidator = new OneOfOptionsValidator(['option1', 'option2']);

        $notNullStringCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $stringValidator]));
        $notNullStringCompositeValidatorCollection = new ValidatorCollectionDecorator($notNullStringCompositeValidator);
        $notNullFloatCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $floatValidator]));
        $notNullFloatCompositeValidatorCollection = new ValidatorCollectionDecorator($notNullFloatCompositeValidator);
        $notNullOneOfOptionsCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $oneOfOptionsValidator]));
        $notNullOneOfOptionsCompositeValidatorCollection = new ValidatorCollectionDecorator($notNullOneOfOptionsCompositeValidator);

        $attributeOneValidator = new AttributeValidator('attributeOne', $notNullStringCompositeValidatorCollection);
        $attributeTwoValidator = new AttributeValidator('attributeTwo', $notNullFloatCompositeValidatorCollection);
        $attributeThreeValidator = new AttributeValidator('attributeThree', $notNullOneOfOptionsCompositeValidatorCollection);

        $attributeRootValidator = new ValidatorComposite(new ArrayObject([
            $attributeOneValidator,
            $attributeTwoValidator,
            $attributeThreeValidator
        ]));

        $attributeRootValidatorCollection = new ValidatorCollectionDecorator($attributeRootValidator);

        $this->sut = new AttributeValidator('attributeRoot', $attributeRootValidatorCollection);

        $actual = [
            'isValid' => $this->sut->validate($input),
            'errorMessage' => $this->sut->getErrorMessage()
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testValidateCollectionNestedWhenObject(): void
    {
        $firstClass = new stdClass();
        $firstClass->attributeOne = [null, null];
        $firstClass->attributeTwo = [1.1, 1.1];
        $firstClass->attributeThree = ['option1', 'option1'];

        $secondClass = new stdClass();
        $secondClass->attributeOne = [null, null];
        $secondClass->attributeTwo = [1.1, 1.1];
        $secondClass->attributeThree = ['option1', 'option1'];

        $input = new stdClass();
        $input->attributeRoot = [$firstClass, $secondClass];

        $expected = [
            'isValid' => false,
            'errorMessage' => [
                'attributeRoot' => [
                    0 => [
                        'attributeOne' => [
                            0 => [
                                0 => 'Cannot be null',
                                1 => 'Invalid string'
                            ],
                            1 => [
                                0 => 'Cannot be null',
                                1 => 'Invalid string'
                            ]
                        ]
                    ],
                    1 => [
                        'attributeOne' => [
                            0 => [
                                0 => 'Cannot be null',
                                1 => 'Invalid string'
                            ],
                            1 => [
                                0 => 'Cannot be null',
                                1 => 'Invalid string'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $notNullValidator = new NotNullValidator();
        $stringValidator = new StringValidator();
        $floatValidator = new FloatValidator();
        $oneOfOptionsValidator = new OneOfOptionsValidator(['option1', 'option2']);

        $notNullStringCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $stringValidator]));
        $notNullStringCompositeValidatorCollection = new ValidatorCollectionDecorator($notNullStringCompositeValidator);
        $notNullFloatCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $floatValidator]));
        $notNullFloatCompositeValidatorCollection = new ValidatorCollectionDecorator($notNullFloatCompositeValidator);
        $notNullOneOfOptionsCompositeValidator = new ValidatorComposite(new ArrayObject([$notNullValidator, $oneOfOptionsValidator]));
        $notNullOneOfOptionsCompositeValidatorCollection = new ValidatorCollectionDecorator($notNullOneOfOptionsCompositeValidator);

        $attributeOneValidator = new AttributeValidator('attributeOne', $notNullStringCompositeValidatorCollection);
        $attributeTwoValidator = new AttributeValidator('attributeTwo', $notNullFloatCompositeValidatorCollection);
        $attributeThreeValidator = new AttributeValidator('attributeThree', $notNullOneOfOptionsCompositeValidatorCollection);

        $attributeRootValidator = new ValidatorComposite(new ArrayObject([
            $attributeOneValidator,
            $attributeTwoValidator,
            $attributeThreeValidator
        ]));

        $attributeRootValidatorCollection = new ValidatorCollectionDecorator($attributeRootValidator);

        $this->sut = new AttributeValidator('attributeRoot', $attributeRootValidatorCollection);

        $actual = [
            'isValid' => $this->sut->validate($input),
            'errorMessage' => $this->sut->getErrorMessage()
        ];

        $this->assertEquals($expected, $actual);
    }
}
