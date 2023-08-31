<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Message;

/**
 * Summary of Message.
 *
 * @template Payload
 * @template Headers
 */
interface Message
{
    /**
     * Summary of getPayload.
     *
     * @return Payload
     */
    public function getPayload(): object;

    /**
     * Summary of getHeaders.
     *
     * @return Headers
     */
    public function getHeaders(): object;
}
