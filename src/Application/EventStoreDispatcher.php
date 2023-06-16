<?php

declare(strict_types=1);

namespace Frete\Core\Application;

use Frete\Core\Domain\EventStore;

interface EventStoreDispatcher extends Dispatcher
{
    public function dispatchStore(EventStore $store): void;
}
