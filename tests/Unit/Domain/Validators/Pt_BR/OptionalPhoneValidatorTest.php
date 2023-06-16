<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Validators\Pt_BR;

use Frete\Core\Domain\Validators\Pt_BR\OptionalPhoneValidator;
use Tests\TestCase;

class OptionalPhoneValidatorTest extends TestCase
{
    /**
     * @dataProvider phoneNumbersSuccesfulyProvider
     *
     * @param mixed $input
     */
    public function testShouldValidatePhone($input)
    {
        $validator = new OptionalPhoneValidator();
        $this->assertTrue($validator->validate($input));
    }

    public static function phoneNumbersSuccesfulyProvider(): iterable
    {
        yield 'format DDI + DDD + phone number' => [
            'input' => '+55(21)98765-5678'
        ];

        yield 'format DDD + phone number' => [
            'input' => '(21)98765-5678'
        ];

        yield 'format only phone number' => [
            'input' => '98765-5678'
        ];

        yield 'format without parentheses DDI + DDD + phone number' => [
            'input' => '+552198765-5678'
        ];

        yield 'format without parentheses and hyphen DDI + DDD + phone number' => [
            'input' => '+55(21)987655678'
        ];

        yield 'format only numbers DDI + DDD + PhoneNumber' => [
            'input' => '+5521987655678'
        ];

        yield 'format only numbers DDI + DDD + PhoneNumber2' => [
            'input' => '+21987655678'
        ];

        yield 'value null' => [
            'input' => null
        ];
    }

    /**
     * @dataProvider phoneNumbersUnsuccessfullyProvider
     *
     * @param mixed $input
     */
    public function testShouldNotValidatePhone($input)
    {
        $validator = new OptionalPhoneValidator();
        $this->assertFalse($validator->validate($input));
        $this->assertEquals('Invalid phone number', $validator->getErrorMessage());
    }

    public static function phoneNumbersUnsuccessfullyProvider(): iterable
    {
        yield 'format with three places DDI' => [
            'input' => '+555(21)98765-5678'
        ];

        yield 'format with three places DDD' => [
            'input' => '(213)98765-5678'
        ];

        yield 'format with ten numbers in phone' => [
            'input' => '98765-56789'
        ];
    }
}
