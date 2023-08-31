<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\MessageBus\Ecotone\Brokers\Redis\Configuration;

use Ecotone\Enqueue\EnqueueMessageConsumerConfiguration;
use Ecotone\Redis\RedisInboundChannelAdapterBuilder;
use Frete\Core\Infrastructure\MessageBus\Ecotone\Brokers\Redis\Connection\RedisConnectionFactory;

final class RedisMessageConsumerConfiguration extends EnqueueMessageConsumerConfiguration
{
    private bool $declareOnStartup = RedisInboundChannelAdapterBuilder::DECLARE_ON_STARTUP_DEFAULT;

    public static function create(string $endpointId, string $queueName, string $connectionReferenceName = RedisConnectionFactory::class): self
    {
        return new self(
            $endpointId,
            $queueName,
            $connectionReferenceName
        );
    }

    public function withDeclareOnStartup(bool $declareOnStartup): self
    {
        $this->declareOnStartup = $declareOnStartup;

        return $this;
    }

    public function isDeclaredOnStartup(): bool
    {
        return $this->declareOnStartup;
    }
}
