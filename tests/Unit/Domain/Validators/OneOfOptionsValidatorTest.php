<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators;

use Frete\Core\Domain\Validators\OneOfOptionsValidator;
use Tests\TestCase;

class OneOfOptionsValidatorTest extends TestCase
{
    public function testShouldValidateOneOfOptions()
    {
        $validator = new OneOfOptionsValidator();
        $options = ['option', 'select', 'checkbox', 'textinput', 'label'];
        $validator->setOptions($options);
        $this->assertTrue($validator->validate('option'));
    }

    public function testShouldNotValidateOneOfOptions()
    {
        $validator = new OneOfOptionsValidator();
        $options = ['option', 'select', 'checkbox', 'textinput', 'label'];
        $validator->setOptions($options);
        $this->assertFalse($validator->validate('textarea'));
        $this->assertEquals('Invalid option', $validator->getErrorMessage());
    }
}
