<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Errors;

use Frete\Core\Domain\Errors\DomainError;
use RuntimeException;
use Tests\TestCase;

class DomainErrorTest extends TestCase
{
    public function testDomainErrorHasProperMessage()
    {
        $message = 'Test error message';
        $error = new DomainError($message);
        $this->assertSame($message, $error->getMessage());
    }

    public function testDomainErrorHasProperCode()
    {
        $code = 123;
        $error = new DomainError('Test error message', $code);
        $this->assertSame($code, $error->getCode());
    }

    public function testDomainErrorHasProperPreviousException()
    {
        $previous = new RuntimeException('Previous Exception');
        $error = new DomainError('Test error message', 0, $previous);
        $this->assertSame($previous, $error->getPrevious());
    }
}
