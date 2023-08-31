<?php

declare(strict_types=1);

namespace Frete\Core\Application;

use Frete\Core\Domain\Message\Message;

/**
 * @implements Message<array, array>
 */
class BaseEvent implements Event
{
    private const PAYLOAD_KEYS = [
        'data',
    ];

    private const HEADER_KEYS = [
        'source',
        'type',
        'version',
        'schema',
        'timestamp',
        'traceId',
    ];

    public function __construct(
        protected array $payload = [],
        protected array $headers = []
    ) {
        $this->payload = array_intersect_key($payload, array_flip(self::PAYLOAD_KEYS));
        $this->headers = array_intersect_key($headers, array_flip(self::HEADER_KEYS));
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}
