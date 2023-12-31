<?php

declare(strict_types=1);

namespace ChapaPhp\Infrastructure\MessageBus\Ecotone\Brokers\Kafka;

use ChapaPhp\Infrastructure\MessageBus\Ecotone\Brokers\Kafka\Configuration\KafkaTopicConfiguration;
use ChapaPhp\Infrastructure\MessageBus\Ecotone\Brokers\Kafka\Connection\KafkaConnectionFactory;
use ChapaPhp\Infrastructure\MessageBus\Ecotone\Brokers\MessageBrokerHeaders\DefaultMessageHeader;
use Ecotone\Enqueue\{CachedConnectionFactory, EnqueueOutboundChannelAdapterBuilder, HttpReconnectableConnectionFactory};
use Ecotone\Messaging\Channel\PollableChannel\Serialization\OutboundMessageConverter;
use Ecotone\Messaging\Config\Container\Definition;
use Ecotone\Messaging\Config\Container\MessagingContainerBuilder;
use Ecotone\Messaging\Config\Container\Reference;
use Ecotone\Messaging\Conversion\ConversionService;
use Ecotone\Messaging\Handler\{ChannelResolver, ReferenceSearchService};
use Enqueue\RdKafka\RdKafkaTopic;
use Ramsey\Uuid\Uuid;

class KafkaOutboundChannelAdapterBuilder extends EnqueueOutboundChannelAdapterBuilder
{
    private array $staticHeadersToAdd = [];

    private function __construct(private string $topicName, private string $connectionFactoryReferenceName, private string $messageBrokerHeadersReferenceName, private ?KafkaTopicConfiguration $topicConfig)
    {
        $this->initialize($connectionFactoryReferenceName);
    }

    public static function create(string $topicName, string $connectionFactoryReferenceName = KafkaConnectionFactory::class, string $messageBrokerHeadersReferenceName = DefaultMessageHeader::class, ?KafkaTopicConfiguration $topicConfig = null): self
    {
        return new self($topicName, $connectionFactoryReferenceName, $messageBrokerHeadersReferenceName, $topicConfig);
    }

    public function build(ChannelResolver $channelResolver, ReferenceSearchService $referenceSearchService): KafkaOutboundChannelAdapter
    {
        /** @var KafkaConnectionFactory $connectionFactory */
        $connectionFactory = $referenceSearchService->get($this->connectionFactoryReferenceName);

        /** @var ConversionService $conversionService */
        $conversionService = $referenceSearchService->get(ConversionService::REFERENCE_NAME);

        $this->topicConfig ??= new KafkaTopicConfiguration();

        return new KafkaOutboundChannelAdapter(
            CachedConnectionFactory::createFor(new HttpReconnectableConnectionFactory($connectionFactory)),
            $this->buildKafkaTopic($this->topicName, $this->topicConfig),
            $this->autoDeclare,
            new OutboundMessageConverter($this->headerMapper, $this->defaultConversionMediaType, $this->defaultDeliveryDelay, $this->defaultTimeToLive, $this->defaultPriority, $this->staticHeadersToAdd),
            $conversionService,
            $connectionFactory->getMessageSerializer()
        );
    }

    public function withStaticHeadersToEnrich(array $headers): self
    {
        $this->staticHeadersToAdd = $headers;

        return $this;
    }

    private function buildKafkaTopic(string $topicName, KafkaTopicConfiguration $topicConfig): RdKafkaTopic
    {
        $kafkaTopic = new RdKafkaTopic($topicName);

        if (!is_null($topicConfig->getpublisherPartition())) {
            $kafkaTopic->setPartition($topicConfig->getpublisherPartition());
        }
        if (!is_null($topicConfig->getPublisherKey())) {
            $kafkaTopic->setKey($topicConfig->getPublisherKey());
        }

        return $kafkaTopic;
    }

    public function compile(MessagingContainerBuilder $builder): Definition
    {
        $connectionFactory = new Definition(CachedConnectionFactory::class, [
            new Definition(KafkaConnectionFactory::class, [
                new Reference($this->connectionFactoryReferenceName),
                Uuid::uuid4()->toString(),
            ]),
        ], 'createFor');

        $outboundMessageConverter = new Definition(OutboundMessageConverter::class, [
            $this->headerMapper,
            $this->defaultConversionMediaType,
            $this->defaultDeliveryDelay,
            $this->defaultTimeToLive,
            $this->defaultPriority,
            $this->staticHeadersToAdd,
        ]);

        return new Definition(KafkaOutboundChannelAdapter::class, [
            $connectionFactory,
            $this->buildKafkaTopic($this->topicName, $this->topicConfig),
            $this->autoDeclare,
            $outboundMessageConverter,
            new Reference(ConversionService::REFERENCE_NAME),
            null
        ]);
    }
}
