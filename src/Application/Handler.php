<?php

declare(strict_types=1);

namespace Frete\Core\Application;

use Frete\Core\Application\Error\ApplicationError;
use Frete\Core\Domain\Message\Message;

/**
 * @template TMessage
 */
interface Handler
{
    /**
     * @template TMessage of Message
     * @template TResult of Result
     * @param TMessage $message
     * @return Result<TResult, ApplicationError>
     */
    public function handle(Message $message): Result;
}
