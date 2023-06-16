<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Ecotone\Brokers\MessageBrokerHeaders;

use Frete\Core\Infrastructure\UuidGenerator;

class DefaultMessageHeader implements IHeaderMessage
{
    public function getSchema(): array
    {
        return [
            'TraceId' => $this->generateTraceId(),
            'Source' => getenv('APP_NAME') ? getenv('APP_NAME') : '',
            'SchemaVersion' => false != getenv('QUEUE_CUSTOM_HEADER_SCHEMA_VERSION') ? getenv('QUEUE_CUSTOM_HEADER_SCHEMA_VERSION') : '1.0',
            'Timestamp' => $this->generateTimestamp(),
            'Key' => false != getenv('QUEUE_CUSTOM_HEADER_KEY') ? getenv('QUEUE_CUSTOM_HEADER_KEY') : '',
            'EventType' => false != getenv('QUEUE_CUSTOM_HEADER_EVENT_TYPE') ? getenv('QUEUE_CUSTOM_HEADER_EVENT_TYPE') : ''
        ];
    }

    private function generateTraceId()
    {
        return UuidGenerator::generate();
    }

    private function generateTimestamp()
    {
        return date('Y-m-d\TH:i:s\Z');
    }
}
