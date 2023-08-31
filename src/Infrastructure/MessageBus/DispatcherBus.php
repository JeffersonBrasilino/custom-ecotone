<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\MessageBus;

use Frete\Core\Application\{Action, Command, Dispatcher, Query};
use Frete\Core\Domain\Event;
use Frete\Core\Domain\EventStore;
use Frete\Core\Infrastructure\Errors\InfrastructureError;
use Frete\Core\Shared\Result;

class DispatcherBus implements Dispatcher
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {
    }

    public function dispatch(Action|Event $message): Result
    {
        try {
            if (is_a($message, Command::class)) {
                return $this->messageBus->sendCommand($message);
            }

            if (is_a($message, Query::class)) {
                return $this->messageBus->sendQuery($message);
            }

            if (is_a($message, Event::class)) {
                return $this->messageBus->publishMessage($message);
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
