<?php

declare(strict_types=1);

namespace Frete\Core\Domain\Message;

use Ds\Queue;

interface MessageStore
{
    /**
     * Summary of store.
     *
     * @param Message $message
     *
     * @return void
     */
    public function store(Message $message): void;

    /**
     * Summary of storeAll.
     *
     * @param Queue<Message> $messages
     *
     * @return void
     */
    public function storeAll(Queue $messages): void;

    /**
     * Summary of get.
     *
     * @param string $id
     *
     * @return Message
     */
    public function get(string $id): Message;

    /**
     * Summary of all.
     *
     * @return Queue<Message>
     */
    public function all(): Queue;
}
