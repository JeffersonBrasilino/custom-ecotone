<?php

declare(strict_types=1);

declare(strict_types=1);

namespace Tests\Unit\Application\Errors;

use Frete\Core\Application\Errors\ApplicationError;
use RuntimeException;
use Tests\TestCase;

class ApplicationErrorTest extends TestCase
{
    public function testConstructor(): void
    {
        // Create an exception with a custom message and code
        $message = 'This is a test message';
        $code = 123;
        $exception = new ApplicationError($message, $code);

        // Check that the message and the code are set correctly
        $this->assertSame($message, $exception->getMessage());
        $this->assertSame($code, $exception->getCode());

        // Check that the previous exception is null
        $this->assertNull($exception->getPrevious());

        // Create another exception as the previous exception
        $previous = new RuntimeException('Previous exception');
        $exception = new ApplicationError($message, $code, $previous);

        // Check that the previous exception is set correctly
        $this->assertSame($previous, $exception->getPrevious());
    }
}
