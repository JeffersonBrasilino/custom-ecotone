<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Message;

use Ds\Pair;

interface MessageBuilder
{
    /**
     * Summary of withPayload.
     */
    public function withMessageData(Pair $data): MessageBuilder;

    /**
     * Summary of withHeader.
     */
    public function withMessageHeader(Pair $header): MessageBuilder;

    /**
     * Summary of build.
     *
     * @template T of Message
     *
     * @return T
     */
    public function buildMessage(): Message;
}
