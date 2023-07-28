<?php

declare(strict_types=1);

namespace Frete\Core\Application;

use Frete\Core\Domain\Event;
use Frete\Core\Shared\Result;

interface Handler
{
    public function handle(Action|Event|IntegrationEvent $actionOrEvent): Result;
}
