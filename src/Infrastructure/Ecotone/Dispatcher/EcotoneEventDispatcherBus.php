<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Ecotone\Dispatcher;

use Ecotone\Messaging\MessagePublisher;
use Ecotone\Modelling\DistributedBus;
use Frete\Core\Application\EventDispatcher;
use Frete\Core\Domain\Event;
use Frete\Core\Domain\EventStore;
use Frete\Core\Infrastructure\Errors\InfrastructureError;
use Frete\Core\Infrastructure\Messaging\MetadataStore;
use Frete\Core\Shared\Result;

class EcotoneEventDispatcherBus implements EventDispatcher
{
    public function __construct(
        private DistributedBus|MessagePublisher $bus,
    ) {
    }

    public function dispatch(Event $event): Result
    {
        try {
            if (is_subclass_of($this->bus, DistributedBus::class)) {
                $this->publishWithDistribuitedBus($event);
            }

            if (is_subclass_of($this->bus, MessagePublisher::class)) {
                $this->publishWithMessagePublisher($event);
            }
            return Result::success(true);
        } catch (\Throwable $e) {
            return Result::failure(new InfrastructureError($e->getMessage()));
        }
    }

    public function dispatchStore(EventStore $store): Result
    {
        foreach ($store->getEvents() as $event) {
            $this->dispatch($event);
            $store->commitEvent($event);
        }

        return Result::success(true);
    }

    private function publishWithDistribuitedBus(Event $event): void
    {

        $route = $event->getRoute();
        if (empty($route)) {
            $route = str_replace('\\', '.', $event::class);
        }

        $metadata = [];
        if (is_a($event, MetadataStore::class)) {
            $metadata = $event->getAllMetadata();
        }
        /** @var DistributedBus */
        $this->bus->convertAndPublishEvent($route, $event, $metadata);
    }

    private function publishWithMessagePublisher(Event $event): void
    {
        if (is_a($event, MetadataStore::class)) {
            /** @var MessagePublisher */
            $this->bus->convertAndSendWithMetadata($event, $event->getAllMetadata());
            return;
        }

        /** @var MessagePublisher */
        $this->bus->convertAndSend($event);
    }
}
