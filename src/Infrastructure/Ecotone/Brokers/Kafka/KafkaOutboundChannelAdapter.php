<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Ecotone\Brokers\Kafka;

use Ecotone\Enqueue\{CachedConnectionFactory, OutboundMessageConverter};
use Ecotone\Messaging\Message;
use Enqueue\RdKafka\RdKafkaTopic;
use Frete\Core\Infrastructure\Ecotone\Brokers\CustomEnqueueOutboundChannelAdapter;
use Frete\Core\Infrastructure\Ecotone\Brokers\MessageBrokerHeaders\IHeaderMessage;
use Interop\Queue\Message as buildMessageReturn;

final class KafkaOutboundChannelAdapter extends CustomEnqueueOutboundChannelAdapter
{
    public function __construct(CachedConnectionFactory $connectionFactory, private RdKafkaTopic $topic, bool $autoDeclare, OutboundMessageConverter $outboundMessageConverter, IHeaderMessage $messageBrokerHeaders)
    {
        parent::__construct(
            $connectionFactory,
            $topic,
            $autoDeclare,
            $outboundMessageConverter,
            $messageBrokerHeaders
        );
    }

    public function initialize(): void
    {
        $context = $this->connectionFactory->createContext();
        $context->createQueue($this->topic->getTopicName());
    }

    public function buildMessage(Message $message): buildMessageReturn
    {
        /** @var \Enqueue\RdKafka\RdKafkaMessage */
        $kafkaMessage = parent::buildMessage($message);
        $props = $kafkaMessage->getProperties();
        if (isset($props['partition']) && is_int($props['partition'])) {
            $kafkaMessage->setPartition($props['partition']);
        }

        if (is_subclass_of($message->getPayload(), \Frete\Core\Domain\Event::class)) {
            $messageId = $message->getPayload()->identifier;
            $kafkaMessage->setMessageId($messageId);
            $kafkaMessage->setKey($messageId);
        }

        return $kafkaMessage;
    }
}
