<?php

declare(strict_types=1);

namespace Frete\Core\Application;

use Exception;
use Frete\Core\Domain\Message\Message;

interface Dispatcher
{
    /**
     * @template TMessage of Message
     * @template TValue
     * @template TError of Exception
     * @param TMessage $message
     * @return Result<TValue, TError>
     */
    public function dispatch(Message $message): Result;
}
