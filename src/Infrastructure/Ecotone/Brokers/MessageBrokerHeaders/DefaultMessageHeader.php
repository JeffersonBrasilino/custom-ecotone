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
            'Timestamp' => $this->generateTimestamp(),
            'SchemaVersion' => null,
            'EventType' => null,
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
