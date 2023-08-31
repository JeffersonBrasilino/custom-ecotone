<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\MessageBus;

interface MessageBusInterface
{
    /**
     * return original instance lib
     */
    public function getRawBus();

    /**
     * return the command bus
     */
    public function getCommandBus();

    /**
     * return the query bus
     */
    public function getQueryBus();

    /**
     * send command
     *
     * @param mixed $command
     *
     * @return mixed
     */
    public function sendCommand($command);

    /**
     * send query
     *
     * @param mixed $query
     *
     * @return mixed
     */
    public function sendQuery($query);

    /**
     * publish event
     *
     * @param mixed $message
     *
     * @param string|\BackedEnum $eventBusType
     *
     * @return void
     */
    public function publishMessage($message, string|\BackedEnum $eventBusType = EventBusTypeEnum::DEFAULT );

}
