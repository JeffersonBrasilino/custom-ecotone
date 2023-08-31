<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Message;

use Ds\Map;

/**
 * Summary of Message.
 */
class BaseMessage implements Message
{
    public function __construct(
        private Map $payload = new Map(),
        private Map $headers = new Map()
    ) {
    }

    /**
     * Summary of getMessage.
     *
     * @return Map<string, mixed>
     */
    public function getPayload(): Map
    {
        return $this->payload->copy();
    }

    /**
     * Summary of getHeaders.
     *
     * @return Map<string, string>
     */
    public function getHeaders(): Map
    {
        return $this->headers->copy();
    }
}
