<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Ecotone\Dispatcher;

use Ecotone\Messaging\MessagePublisher;
use Ecotone\Modelling\{CommandBus, QueryBus};
use Frete\Core\Application\EventStoreDispatcher;
use Frete\Core\Application\{Action, Command, Dispatcher, Query};
use Frete\Core\Domain\Event;
use Frete\Core\Domain\EventStore;
use Frete\Core\Infrastructure\Errors\InfrastructureError;
use Frete\Core\Infrastructure\Messaging\MetadataStore;
use Frete\Core\Shared\Result;

class DispatcherBus implements Dispatcher, EventStoreDispatcher
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly QueryBus $queryBus,
    ) {
    }

    public function dispatch(Action|Event $message): Result
    {
        try {
            if (is_a($message, Command::class)) {
                return $this->commandBus->send($message);
            }

            if (is_a($message, Query::class)) {
                return $this->queryBus->send($message);
            }

        } catch (\Throwable $e) {
            return Result::failure(new InfrastructureError($e->getMessage()));
        }

        return Result::failure(new InfrastructureError('Message not supported.'));
    }

    public function dispatchStore(EventStore $store): Result
    {
        foreach ($store->getEvents() as $event) {
            $this->dispatch($event);
            $store->commitEvent($event);
        }

        return Result::success(true);
    }
}
