<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Ecotone\Brokers\MessageBrokerHeaders;

interface IHeaderMessage
{
    public function getSchema(): array;
}
