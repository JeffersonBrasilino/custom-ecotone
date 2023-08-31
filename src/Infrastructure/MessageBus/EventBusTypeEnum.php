<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\MessageBus;

enum EventBusTypeEnum: string
{
    case DEFAULT = 'default';
    case ROUTING = 'routing';
}
