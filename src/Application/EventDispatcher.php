<?php

declare(strict_types=1);

namespace Frete\Core\Application;
use Frete\Core\Domain\Event;
use Frete\Core\Domain\EventStore;
use Frete\Core\Shared\Result;

interface EventDispatcher
{
    public function dispatchStore(EventStore $store): Result;
    public function dispatch(Event $message): Result;
}
