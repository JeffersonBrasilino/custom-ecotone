<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Ecotone\Brokers\Sqs;

use Ecotone\Enqueue\CachedConnectionFactory;
use Ecotone\Messaging\Channel\PollableChannel\Serialization\OutboundMessageConverter;
use Ecotone\Messaging\Conversion\ConversionService;
use Enqueue\Sqs\SqsContext;
use Enqueue\Sqs\SqsDestination;
use Frete\Core\Infrastructure\Ecotone\Brokers\CustomEnqueueOutboundChannelAdapter;
use Frete\Core\Infrastructure\Ecotone\Brokers\MessageBrokerHeaders\IHeaderMessage;

final class CustomSqsOutboundChannelAdapter extends CustomEnqueueOutboundChannelAdapter
{
    public function __construct(
        CachedConnectionFactory $connectionFactory,
        private string $queueName,
        bool $autoDeclare,
        OutboundMessageConverter $outboundMessageConverter,
        ConversionService $conversionService,
        IHeaderMessage $messageBrokerHeaders
    ) {
        parent::__construct(
            $connectionFactory,
            new SqsDestination($queueName),
            $autoDeclare,
            $outboundMessageConverter,
            $conversionService,
            $messageBrokerHeaders
        );
    }

    public function initialize(): void
    {
        /** @var SqsContext */
        $context = $this->connectionFactory->createContext();
        $context->declareQueue($context->createQueue($this->queueName));
    }
}
