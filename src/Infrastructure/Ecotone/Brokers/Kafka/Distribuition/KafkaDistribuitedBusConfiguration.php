<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Ecotone\Brokers\Kafka\Distribuition;

use Ecotone\Modelling\DistributedBus;
use Frete\Core\Infrastructure\Ecotone\Brokers\Kafka\Configuration\KafkaTopicConfiguration;
use Frete\Core\Infrastructure\Ecotone\Brokers\Kafka\Connection\KafkaConnectionFactory;
use Frete\Core\Infrastructure\Ecotone\Brokers\MessageBrokerHeaders\DefaultMessageHeader;

/**
 * Class RegisterAmqpPublisher.
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class KafkaDistribuitedBusConfiguration
{
    public const DEFAULT_UNIQUE_DISTRIBUTION_KEY = 'distribution_bus_';
    private const DISTRIBUTION_TYPE_PUBLISHER = 'publisher';
    private const DISTRIBUTION_TYPE_CONSUMER = 'consumer';
    private const DISTRIBUTION_TYPE_BOTH = 'both';

    private bool $autoDeclareOnSend = true;
    private string $connectionReference;
    private ?string $outputDefaultConversionMediaType;
    private string $referenceName;
    private string $headerMapper = '*';
    private bool $defaultPersistentDelivery = true;
    private string $distributionType;
    private string $messageBrokerHeadersReferenceName;
    private ?KafkaTopicConfiguration $topicConfig;
    private string $topicName;
    private ?string $endpointId = null;

    private function __construct(string $topicName, ?string $endpointId, string $kafkaConnectionReference, ?string $outputDefaultConversionMediaType, string $referenceName, string $distributionType, string $messageBrokerHeadersReferenceName, ?KafkaTopicConfiguration $topicConfig)
    {
        $this->connectionReference = $kafkaConnectionReference;
        $this->outputDefaultConversionMediaType = $outputDefaultConversionMediaType;
        $this->referenceName = $referenceName;
        $this->distributionType = $distributionType;
        $this->messageBrokerHeadersReferenceName = $messageBrokerHeadersReferenceName;
        $this->topicConfig = $topicConfig;
        $this->topicName = $topicName;
        $this->endpointId = $endpointId;
    }

    public static function createPublisher(string $topicName, string $busReferenceName = DistributedBus::class, ?string $outputDefaultConversionMediaType = null, string $kafkaConnectionReference = KafkaConnectionFactory::class, string $messageBrokerHeadersReferenceName = DefaultMessageHeader::class, ?KafkaTopicConfiguration $topicConfig = null): self
    {
        return new self($topicName, null, $kafkaConnectionReference, $outputDefaultConversionMediaType, $busReferenceName, self::DISTRIBUTION_TYPE_PUBLISHER, $messageBrokerHeadersReferenceName, $topicConfig);
    }

    public static function createConsumer(string $topicName, string $endpointId, string $kafkaConnectionReference = KafkaConnectionFactory::class, string $messageBrokerHeadersReferenceName = DefaultMessageHeader::class, ?KafkaTopicConfiguration $topicConfig = null): self
    {
        return new self($topicName, $endpointId, $kafkaConnectionReference, null, '', self::DISTRIBUTION_TYPE_CONSUMER, $messageBrokerHeadersReferenceName, $topicConfig);
    }

    public function isPublisher(): bool
    {
        return in_array($this->distributionType, [self::DISTRIBUTION_TYPE_PUBLISHER, self::DISTRIBUTION_TYPE_BOTH]);
    }

    public function isConsumer(): bool
    {
        return in_array($this->distributionType, [self::DISTRIBUTION_TYPE_CONSUMER, self::DISTRIBUTION_TYPE_BOTH]);
    }

    /**
     * @return string
     */
    public function getConnectionReference(): string
    {
        return $this->connectionReference;
    }

    /**
     * @param string $headerMapper comma separated list of headers to be mapped.
     *                             (e.g. "\*" or "thing1*, thing2" or "*thing1")
     */
    public function withHeaderMapper(string $headerMapper): static
    {
        $this->headerMapper = $headerMapper;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDefaultPersistentDelivery(): bool
    {
        return $this->defaultPersistentDelivery;
    }

    /**
     * @param bool $defaultPersistentDelivery
     */
    public function withDefaultPersistentDelivery(bool $defaultPersistentDelivery): static
    {
        $this->defaultPersistentDelivery = $defaultPersistentDelivery;
        return $this;
    }

    public function getDefaultPersistentDelivery(): bool
    {
        return $this->defaultPersistentDelivery;
    }

    /**
     * @return string
     */
    public function getHeaderMapper(): string
    {
        return $this->headerMapper;
    }

    /**
     * @return null|string
     */
    public function getOutputDefaultConversionMediaType(): ?string
    {
        return $this->outputDefaultConversionMediaType;
    }

    /**
     * @return string
     */
    public function getReferenceName(): string
    {
        return $this->referenceName;
    }

    public function getKafkaTopicConfiguration(): ?KafkaTopicConfiguration
    {
        return $this->topicConfig;
    }

    public function getmessageBrokerHeadersReferenceName(): string
    {
        return $this->messageBrokerHeadersReferenceName;
    }

    public function getQueueName(): string
    {
        return $this->topicName;
    }

    public function isAutoDeclareOnSend(): bool
    {
        return $this->autoDeclareOnSend;
    }

    public function withAutoDeclareQueueOnSend(bool $autoDeclareQueueOnSend): self
    {
        $this->autoDeclareOnSend = $autoDeclareQueueOnSend;

        return $this;
    }

    public function getEndpointId(): string
    {
        return $this->endpointId;
    }
}
