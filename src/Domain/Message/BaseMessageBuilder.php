<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Message;

use Ds\Map;
use Ds\Pair;

class BaseMessageBuilder implements MessageBuilder
{
    /**
     * @var Map<string, mixed>
     */
    private Map $payload;

    /**
     * @var Map<string, mixed>
     */
    private Map $headers;

    public function __construct(private readonly string $messageClass)
    {
        $this->payload = new Map();
        $this->headers = new Map();
    }

    /**
     * Summary of withPayload.
     */
    public function withMessageData(Pair $data): MessageBuilder
    {
        $this->payload->offsetSet($data->key, $data->value);

        return $this;
    }

    /**
     * Summary of withHeader.
     */
    public function withMessageHeader(Pair $header): MessageBuilder
    {
        $this->headers->offsetSet($header->key, $header->value);

        return $this;
    }

    /**
     * Summary of build.
     */
    public function buildMessage(): BaseMessage
    {
        $message = new $this->messageClass($this->payload, $this->headers);

        $this->payload = new Map();
        $this->headers = new Map();

        return $message;
    }
}
