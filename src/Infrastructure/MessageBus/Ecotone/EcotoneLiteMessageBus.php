<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\MessageBus\Ecotone;

use Ecotone\Lite\EcotoneLite;
use Ecotone\Messaging\Config\ConfiguredMessagingSystem;
use Ecotone\Messaging\Config\ServiceConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Frete\Core\Infrastructure\MessageBus\MessageBusInterface;
use Psr\Container\ContainerInterface;
use Frete\Core\Infrastructure\MessageBus\EventBusTypeEnum;

class EcotoneLiteMessageBus implements MessageBusInterface
{
    /**
     * @var ConfiguredMessagingSystem
     */
    private $ecotoneInstance = null;

    /**
     * @var array<string>
     */
    private $namespaces = ['Frete\\Core'];

    /**
     * @var ContainerInterface| array<object>
     */
    private $servicesProvidersInstance = [];

    /**
     * @var string
     */
    private $serviceName = 'App';

    public function __construct()
    {
    }

    /**
     * Set the container or array of available services
     *
     * @param ContainerInterface|array $servicesProvidersInstance
     *
     * @return self
     */
    public function withAvailableServices(ContainerInterface|array $servicesProvidersInstance): self
    {
        $this->servicesProvidersInstance = $servicesProvidersInstance;
        return $this;
    }

    /**
     * Set the namespaces for lib analyze annotations
     *
     * @param array $namespaces
     *
     * @return self
     */
    public function withNamespaces(array $namespaces): self
    {
        $this->namespaces = array_merge($this->namespaces, $namespaces);
        return $this;
    }

    /**
     * Set the service name
     *
     * @param string $namespaces
     *
     * @return self
     */
    public function withServiceName(string $name): self
    {
        $this->serviceName = $name;
        return $this;
    }

    /**
     * start the service
     *
     * @return self
     */
    public function run(): self
    {
        $this->ecotoneInstance = EcotoneLite::bootstrap(
            containerOrAvailableServices: $this->servicesProvidersInstance,
            configuration: ServiceConfiguration::createWithDefaults()
                ->withFailFast(false)
                ->withNamespaces($this->namespaces)
                ->withDefaultSerializationMediaType(MediaType::APPLICATION_JSON)
                ->withServiceName($this->serviceName)
        );

        return $this;
    }

    /**
     * return original instance lib
     *
     * @return ConfiguredMessagingSystem
     */
    public function getRawBus(): ConfiguredMessagingSystem
    {
        return $this->ecotoneInstance;
    }

    /**
     * return the command bus
     *
     * @return \Ecotone\Modelling\CommandBus
     */
    public function getCommandBus()
    {
        return $this->ecotoneInstance->getCommandBus();
    }

    /**
     * return the query bus
     *
     * @return \Ecotone\Modelling\QueryBus
     */
    public function getQueryBus()
    {
        return $this->ecotoneInstance->getQueryBus();
    }

    /**
     * return the event bus
     *
     * @return \Ecotone\Modelling\EventBus
     */
    public function getEventBus(string $eventBusType = 'default')
    {
        return $this->ecotoneInstance->getEventBus();
    }

    /**
     * send command
     *
     * @param mixed $command
     *
     * @return mixed
     */
    public function sendCommand($command)
    {
        return $this->getCommandBus()->send($command);
    }

    /**
     * send query
     *
     * @param mixed $query
     *
     * @return mixed
     */
    public function sendQuery($query)
    {
        return $this->getQueryBus()->send($query);
    }

    /**
     * publish event
     *
     * @param mixed $message
     *
     * @param string|\BackedEnum $eventBusType
     *
     * @return void
     */
    public function publishMessage($message, string|\BackedEnum $eventBusType = EventBusTypeEnum::DEFAULT )
    {
        dd('publish message called', $message);
    }
}
